<?php

namespace App\Constants;

interface NotificationServiceTemplateNames {
    const WORKOUT_REMINDERS = 'workout_reminders';
    const APPOINTMENT = 'appointment';
    const EVENTS = 'events';
    const CONTENT = 'content';
    const MEAL = 'meal';
    const GOALS_AND_ACHIEVEMENT = 'goals_and_achievement';
    const BILLING_REMINDER = 'billing_reminder';
    const PAYMENT = 'payment';
    const ANNOUNCEMENTS = 'announcements';

    const All_TEMPLATES = [
        self::WORKOUT_REMINDERS,
        self::APPOINTMENT,
        self::EVENTS,
        self::CONTENT,
        self::MEAL,
        self::GOALS_AND_ACHIEVEMENT,
        self::BILLING_REMINDER,
        self::PAYMENT,
        self::ANNOUNCEMENTS,
    ];
}

