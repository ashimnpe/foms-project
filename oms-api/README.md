## DATABASE IMPORT
```

I
INSERT INTO `categories` (`id`, `title`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mo:Mo', '/categories/momo202209100255.jpg', '2022-09-10 02:55:55', '2022-09-10 02:55:55', NULL),
(2, 'Chowmein', '/categories/chowmein202209100256.jpg', '2022-09-10 02:56:18', '2022-09-10 02:56:18', NULL),
(3, 'Pizza', '/categories/pizza202209100259.jpg', '2022-09-10 02:56:35', '2022-09-10 02:59:19', NULL),
(4, 'Snacks', '/categories/snacks202209100256.jpg', '2022-09-10 02:56:51', '2022-09-10 02:56:51', NULL),
(5, 'Sandwich', '/categories/sandwich202209100257.jpg', '2022-09-10 02:57:09', '2022-09-10 02:57:09', NULL),
(6, 'Thukpa', '/categories/thukpa202209100257.jpg', '2022-09-10 02:57:25', '2022-09-10 02:57:25', NULL),
(7, 'Burger', '/categories/burger202209100409.jpg', '2022-09-10 04:09:20', '2022-09-10 04:09:20', NULL);


INSERT INTO `products` (`id`, `title`, `category_id`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Chicken Mo:Mo', 1, 240, '/products/chicken-momo202209100535.jpg', '2022-09-10 05:35:12', '2022-09-10 05:35:12'),
(2, 'Veg Mo:Mo', 1, 180, '/products/veg-momo202209100535.jpg', '2022-09-10 05:35:27', '2022-09-10 05:35:27'),
(3, 'C Mo:Mo', 1, 270, '/products/c-momo202209100535.jpg', '2022-09-10 05:35:59', '2022-09-10 05:35:59'),
(4, 'Buff Mo:Mo', 1, 150, '/products/buff-momo202209100536.jpg', '2022-09-10 05:36:15', '2022-09-10 05:36:15'),
(5, 'Fry Mo:Mo', 1, 150, '/products/fry-momo202209100536.jpg', '2022-09-10 05:36:27', '2022-09-10 05:36:27'),
(6, 'Chicken Chowmein', 2, 110, '/products/chicken-chowmein202209100536.jpg', '2022-09-10 05:36:46', '2022-09-10 05:36:46'),
(7, 'Veg Chowmein', 2, 90, '/products/veg-chowmein202209100539.jpg', '2022-09-10 05:39:49', '2022-09-10 05:39:49'),
(8, 'Buff Chowmein', 2, 90, '/products/buff-chowmein202209100540.jpg', '2022-09-10 05:40:03', '2022-09-10 05:40:03'),
(9, 'Cheese Pizza', 3, 250, '/products/cheese-pizza202209100540.jpg', '2022-09-10 05:40:27', '2022-09-10 05:40:27'),
(10, 'Mushroom Pizza', 3, 280, '/products/mushroom-pizza202209100540.jpg', '2022-09-10 05:40:42', '2022-09-10 05:40:42'),
(11, 'Chicken Pizza', 3, 240, '/products/chicken-pizza202209100540.jpg', '2022-09-10 05:40:53', '2022-09-10 05:40:53'),
(12, 'Pepperoni Pizza', 3, 300, '/products/pepperoni-pizza202209100541.jpg', '2022-09-10 05:41:19', '2022-09-10 05:41:19'),
(13, 'Samosa', 4, 25, '/products/samosa202209100541.jpg', '2022-09-10 05:41:38', '2022-09-10 05:41:38'),
(14, 'Pakoda', 4, 50, '/products/pakoda202209100541.jpg', '2022-09-10 05:41:49', '2022-09-10 05:41:49'),
(15, 'Aalu Chana', 4, 35, '/products/aalu-chana202209100542.jpg', '2022-09-10 05:42:08', '2022-09-10 05:42:08'),
(16, 'Aalu Paratha', 4, 40, '/products/aalu-paratha202209100542.jpg', '2022-09-10 05:42:20', '2022-09-10 05:42:20'),
(17, 'Chicken Chilli', 4, 250, '/products/chicken-chilli202209100542.jpg', '2022-09-10 05:42:33', '2022-09-10 05:42:33'),
(18, 'Chicken Sausage', 4, 50, '/products/chicken-sausage202209100542.jpg', '2022-09-10 05:42:48', '2022-09-10 05:42:48'),
(19, 'Buff Sausage', 4, 40, '/products/buff-sausage202209100543.png', '2022-09-10 05:43:00', '2022-09-10 05:43:00'),
(20, 'French Fries', 4, 125, '/products/french-fries202209100543.jpg', '2022-09-10 05:43:22', '2022-09-10 05:43:22'),
(21, 'Wai Wai Sadheko', 4, 100, '/products/wai-wai-sadheko202209100543.jpg', '2022-09-10 05:43:37', '2022-09-10 05:43:37'),
(22, 'Chicken Sandwich', 5, 75, '/products/chicken-sandwich202209100544.jpg', '2022-09-10 05:44:12', '2022-09-10 05:44:12'),
(23, 'Buff Sandwich', 5, 80, '/products/buff-sandwich202209100544.jpg', '2022-09-10 05:44:28', '2022-09-10 05:44:28'),
(24, 'Tuna Sandwich', 5, 125, '/products/tuna-sandwich202209100544.jpg', '2022-09-10 05:44:42', '2022-09-10 05:44:42'),
(25, 'Veg Sandwich', 5, 75, '/products/veg-sandwich202209100544.jpg', '2022-09-10 05:44:54', '2022-09-10 05:44:54'),
(26, 'Egg Thukpa', 6, 60, '/products/egg-thukpa202209100545.jpg', '2022-09-10 05:45:15', '2022-09-10 05:45:15'),
(27, 'Chicken thukpa', 6, 75, '/products/chicken-thukpa202209100545.jpg', '2022-09-10 05:45:28', '2022-09-10 05:45:28'),
(28, 'Veg Thukpa', 6, 50, '/products/veg-thukpa202209100546.jpg', '2022-09-10 05:46:21', '2022-09-10 05:46:21'),
(29, 'Buff Thukpa', 6, 60, '/products/buff-thukpa202209100546.jpg', '2022-09-10 05:46:35', '2022-09-10 05:46:35'),
(30, 'Chicken Burger', 7, 175, '/products/chicken-burger202209100546.jpg', '2022-09-10 05:46:50', '2022-09-10 05:46:50'),
(31, 'Hamburger', 7, 180, '/products/hamburger202209100546.jpg', '2022-09-10 05:46:59', '2022-09-10 05:46:59');



INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ashim Neupane', 'ashim@gmail.com', 'admin', NULL, '$2y$10$sAhbSo8afgudBKayR2SG6.RPlxAEw/2c8zUA/T/Ky/Lx4L6QT/e7y', NULL, NULL, NULL),
(2, 'Dipen Chand', 'dipen@gmail.com', 'staff', NULL, '$2y$10$XBmlTK0r0l8P91c4w/Nj2O9V4pNBNEi/iOHRhQFjafxa7tidH1IGS', NULL, '2022-09-10 07:36:54', '2022-09-10 07:36:54'),
(3, 'Amar Neupane', 'amar@gmail.com', 'chef', NULL, '$2y$10$Ik3DvC6/aQJ/UfYLSPJeiuL7aJZ19TK6EOjMDo4dysrh6hQ2zcbG.', NULL, '2022-09-10 07:37:26', '2022-09-10 07:37:26'),
(4, 'Prashant Chaudhary', 'prashant@gmail.com', 'chef', NULL, '$2y$10$UE1caTvbJf0CoNjY90o9SuljHqcWltFlUYliw2DH9kyKKmMjPSA0C', NULL, '2022-09-10 07:37:51', '2022-09-10 07:37:51');


```
