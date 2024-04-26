<?php

namespace App\Http\Controllers\API;

use App\Constants\NotificationServiceTemplateNames;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\NutritionPlan;
use App\Models\NutritionPlanDayMeal;
use App\Models\User;
use Error;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class NotificationAPIController extends AppBaseController
{

    public static $endPoints = [
        'get.messages'   => 'v2/messaging',
        'post.messaging'    => 'v2/messaging/send/notification'
    ];

    public static function get(Request $request, $endPoint)
    {
        if (!array_key_exists($endPoint, self::$endPoints)) {
            throw new \Exception("Invalid Payment service Endpoint");
        }

        $token   = config('services.notification.token');
        $baseUrl = config('services.notification.base_url');

        $headers = [
            'Content-Type'   => 'application/json',
            'x-access-token' => $token
        ];

        try {
            $response = Http::withHeaders($headers)->get($baseUrl . '/' . self::$endPoints[$endPoint], $request->all());
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('notification_service_err-->' . $e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public static function post(Request $request, $endPoint)
    {
        if (!array_key_exists($endPoint, self::$endPoints)) {
            throw new \Exception("Invalid Payment service Endpoint");
        }

        $token   = config('services.notification.token');
        $baseUrl = config('services.notification.base_url');

        $headers = [
            'Content-Type'   => 'application/json',
            'x-access-token' => $token
        ];

        try {
            $response = Http::withHeaders($headers)->post($baseUrl . '/' . self::$endPoints[$endPoint], $request->all());
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('notification_service_err-->' . $e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public static function sendNotification(User $user, $NOTIFICATION_TYPE, $refId)
    {
        $userDeviceTokens = $user->devices->pluck('device_token');

        $userWithDeviceTokens = [
            "_id" => strval($user->id),
            "device_tokens" => $userDeviceTokens
        ];
        $notificationRequest = new Request([
            "users" => [
                $userWithDeviceTokens
            ],
            "template_name" => $NOTIFICATION_TYPE,
            "data" => [
                "ref_id" => $refId,
                "notification_type" => $NOTIFICATION_TYPE,
                "user_name" => $user->name
            ]
        ]);
        $sendNotificationResponse = self::post($notificationRequest, 'post.messaging');

        if (!$sendNotificationResponse['status'])
            \Log::warning('Notification (' . $NOTIFICATION_TYPE . ') ' . $sendNotificationResponse['message']);

        return $sendNotificationResponse;
    }

    public function testNotification(Request $request)
    {
        try {
            if (!in_array($request->type, NotificationServiceTemplateNames::All_TEMPLATES))
                throw new Error('Type is Invalid');

            $user = $request->user();

            $notificationResponse   = null;
            $notificationRefModule  = null;
            $notificationType       = null;

            switch ($request->type) {
                case NotificationServiceTemplateNames::APPOINTMENT:
                    $notificationType = NotificationServiceTemplateNames::APPOINTMENT;
                    $notificationRefModule = Appointment::where('customer_id', $user->id)->first();
                    if (!$notificationRefModule)
                        throw new Error('No Appointment Found');
                    break;

                case NotificationServiceTemplateNames::MEAL:
                    $notificationType = NotificationServiceTemplateNames::MEAL;
                    $nutritionPlanId = $user->details?->current_nutrition_plan_id;
                    if (!$nutritionPlanId)
                        throw new Error('Nutrition Plan is not available');

                    $notificationRefModule = NutritionPlanDayMeal::whereHas('nutritionPlanDay', function ($nutritionPlanDay) use ($nutritionPlanId) {
                        return $nutritionPlanDay->where('nutrition_plan_id', $nutritionPlanId);
                    })->first();

                    if (!$notificationRefModule)
                        throw new Error('Nutrition Plan Day Meal is not available');

                    break;
                default :
                    throw new Error('Other Test Notifications is not available');
            }

            $notificationResponse = NotificationAPIController::sendNotification($user, $notificationType, $notificationRefModule->id);
            return $this->sendResponse($notificationRefModule, $notificationResponse['message']);
        } catch (\Error $e) {
            return $this->sendError($e->getMessage(), 403);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }
}
