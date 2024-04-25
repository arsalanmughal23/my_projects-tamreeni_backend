TRUNCATE TABLE menus;

INSERT  INTO `menus`(`id`,`name`,`icon`,`slug`,`position`,`status`,`created_at`,`updated_at`,`deleted_at`) VALUES 
(1,'Pages','glass','pages',1,1,'2024-02-27 13:00:27','2024-02-27 13:00:27',NULL),
(2,'Setting','cog','settings',2,1,'2024-02-27 13:00:27','2024-02-27 13:00:27',NULL),
(3,'Slots','calendar','slots',0,1,'2024-03-21 12:24:33','2024-03-21 12:24:33',NULL),
(4,'Appointments','check','appointments',0,1,'2024-03-21 17:51:43','2024-03-21 17:51:43',NULL),
(5,'Packages','folder','packages',0,1,'2024-03-21 17:52:06','2024-03-21 17:52:06',NULL),
(6,'Transactions','dollar','transactions',0,1,'2024-03-21 17:52:22','2024-03-21 17:52:22',NULL),
(7,'User Subscriptions','reorder','user_subscriptions',0,1,'2024-03-22 16:35:07','2024-03-22 16:35:07',NULL),
(8,'Meal Types','cutlery','meal_types',0,1,'2024-03-25 09:32:12','2024-03-25 09:32:12',NULL),
(9,'Workout Days','glass','workout_days',0,1,'2024-04-01 08:01:17','2024-04-01 08:01:17',NULL),
(10,'Workout Day Exercises','glass','workout_day_exercises',0,1,'2024-04-01 08:01:58','2024-04-01 08:01:58',NULL),
(11,'Workout Plans','glass','workout_plans',0,1,'2024-04-02 08:09:37','2024-04-02 08:09:37',NULL),
(12,'Nutrition Plans','glass','nutrition_plans',0,1,'2024-04-03 09:53:30','2024-04-03 09:53:30',NULL),
(13,'Nutrition Plan Days','glass','nutrition_plan_days',0,1,'2024-04-03 09:53:42','2024-04-03 09:53:42',NULL),
(14,'Nutrition Plan Day Meals','glass','nutrition_plan_day_meals',0,1,'2024-04-03 09:53:52','2024-04-03 09:53:52',NULL);