<?php

namespace App\Http\Controllers\API;

use App\Constants\NotificationServiceTemplateNames;
use App\Http\Controllers\AppBaseController;
use App\Models\Appointment;
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

    public static function sendNotification(User $user, $NOTIFICATION_TYPE, $refId, $title = [], $message = [])
    {
        if (!is_array($title) || count($title) < 2)
            $title = ['Title', 'عنوان'];

        if (!is_array($message) || count($message) < 2)
            $message = ['Message', 'رسالة'];

        $userDeviceTokens = $user->devices->pluck('device_token');
        $userWithDeviceTokens = [
            "_id" => strval($user->id),
            "device_tokens" => $userDeviceTokens
        ];
        $payload = [
            "users" => [
                $userWithDeviceTokens
            ],
            "template_name" => $NOTIFICATION_TYPE,
            "data" => [
                "title" => json_encode([
                    'en' => is_string($title[0]) ? $title[0] : 'title',
                    'ar' => is_string($title[1]) ? $title[1] : 'عنوان',
                ]),
                "message" => json_encode([
                    'en' => is_string($message[0]) ? $message[0] : 'body',
                    'ar' => is_string($message[1]) ? $message[1] : 'هيئة',
                ]),
                "ref_id" => $refId,
                "notification_type" => $NOTIFICATION_TYPE,
                "user_name" => $user->name
            ]
        ];
        $notificationRequest = new Request($payload);
        $sendNotificationResponse = self::post($notificationRequest, 'post.messaging');

        if (!$sendNotificationResponse['status'])
            \Log::warning('Notification (' . $NOTIFICATION_TYPE . ') ' . json_encode($sendNotificationResponse['error'] ?? []));

        // return $sendNotificationResponse;
        return [
            'status' => $sendNotificationResponse['status'],
            'response' => $sendNotificationResponse,
            'payload' => $payload
        ];
    }

    public function testNotification(Request $request)
    {
        try {
            if (!in_array($request->type, NotificationServiceTemplateNames::All_TEMPLATES))
                throw new Error('Type is Invalid');

            $user_id = $request->get('user_id', null);
            $user = null;
            if($user_id)
                $user = User::find($user_id);

            if($user_id && !$user)
                throw new Error('User not found');

            $user = $user ?? $request->user();
            $notificationResponse = NotificationAPIController::sendNotification($user, $request->type, 1);

            if (!$notificationResponse['status'])
                $responseMessage = json_encode($notificationResponse['response']['error']);
            else
                $responseMessage = $notificationResponse['response']['message'];

            return $this->sendResponse($notificationResponse, $responseMessage ?? null);
        } catch (\Error $e) {
            return $this->sendError($e->getMessage(), 403);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    // public function testNotification(Request $request)
    // {
    //     try {
    //         if (!in_array($request->type, NotificationServiceTemplateNames::All_TEMPLATES))
    //             throw new Error('Type is Invalid');

    //         $user_id = $request->get('user_id', null);
    //         $user = null;
    //         if($user_id)
    //             $user = User::find($user_id);

    //         if($user_id && !$user)
    //             throw new Error('User not found');

    //         $user = $user ?? $request->user();

    //         $notificationResponse   = null;
    //         $notificationRefModule  = null;
    //         $notificationType       = null;
    //         $title = [];
    //         $message = [];

    //         switch ($request->type) {
    //             case NotificationServiceTemplateNames::APPOINTMENT:
    //                 $notificationType = NotificationServiceTemplateNames::APPOINTMENT;
    //                 // TODO :: Make Title & Body multi-lingual content through using singleton
    //                 // Multi-Language title & body must have en & ar langauges
    //                 $title = ['Appointment Reminder', 'منبه مواعيد'];
    //                 $message = ['This is a reminder for your appointment', 'هذا تذكير لموعدك'];
    //                 $notificationRefModule = Appointment::where('customer_id', $user->id)->first();
    //                 if (!$notificationRefModule)
    //                     throw new Error('No Appointment Found');
    //                 break;

    //             case NotificationServiceTemplateNames::MEAL:
    //                 $notificationType = NotificationServiceTemplateNames::MEAL;
    //                 $title = ['Meal Reminder', 'تذكير وجبة'];
    //                 $message = ['This is a reminder for your meal', 'هذا تذكير لوجبتك'];

    //                 $nutritionPlanId = $user->details?->current_nutrition_plan_id;
    //                 if (!$nutritionPlanId)
    //                     throw new Error('Nutrition Plan is not available');

    //                 $notificationRefModule = NutritionPlanDayMeal::whereHas('nutritionPlanDay', function ($nutritionPlanDay) use ($nutritionPlanId) {
    //                     return $nutritionPlanDay->where('nutrition_plan_id', $nutritionPlanId);
    //                 })->first();

    //                 if (!$notificationRefModule)
    //                     throw new Error('Nutrition Plan Day Meal is not available');

    //                 break;
    //             default :
    //                 throw new Error('Other Test Notifications is not available');
    //         }

    //         $notificationResponse = NotificationAPIController::sendNotification($user, $notificationType, $notificationRefModule->id, $title, $message);
    //         return $this->sendResponse($notificationRefModule, $notificationResponse['message']);
    //     } catch (\Error $e) {
    //         return $this->sendError($e->getMessage(), 403);
    //     } catch (\Exception $e) {
    //         return $this->sendError($e->getMessage(), 422);
    //     }
    // }
}
