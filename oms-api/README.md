## DATABASE IMPORT
```

INSERT INTO `categories` (`id`, `title`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mo:Mo', '/categories/momo202209080653.jpg', '2022-09-08 06:30:11', '2022-09-08 06:53:29', NULL),
(2, 'Chowmein', '/categories/chowmein202209080630.jpg', '2022-09-08 06:30:20', '2022-09-08 06:30:20', NULL),
(3, 'Burger', '/categories/burger202209080630.jpg', '2022-09-08 06:30:47', '2022-09-08 06:30:47', NULL),
(4, 'Pizza', '/categories/pizza202209080630.jpg', '2022-09-08 06:30:58', '2022-09-08 06:30:58', NULL),
(5, 'Thukpa', '/categories/thukpa202209080631.jpg', '2022-09-08 06:31:07', '2022-09-08 06:31:07', NULL),
(6, 'Biryani', '/categories/biryani202209080631.jpg', '2022-09-08 06:31:18', '2022-09-08 06:31:18', NULL),
(7, 'Sandwich', '/categories/sandwich202209080631.jpg', '2022-09-08 06:31:32', '2022-09-08 06:31:32', NULL),
(8, 'Snacks', '/categories/snacks202209080631.jpg', '2022-09-08 06:31:42', '2022-09-08 06:31:42', NULL),
(9, 'Hot Drinks', '/categories/hot-drinks202209080631.jpg', '2022-09-08 06:31:55', '2022-09-08 06:31:55', NULL),
(10, 'Cold Drinks', '/categories/cold-drinks202209080632.jpg', '2022-09-08 06:32:06', '2022-09-08 06:32:06', NULL);




INSERT INTO `products` (`id`, `title`, `category_id`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Chicken Mo:Mo', 1, 170, '/food/momo/chicken_momo.jpg', '2022-07-28 09:51:47', '2022-07-28 09:51:47'),
(2, 'Veg Mo:Mo', 1, 150, '/food/momo/veg_momo.jpg', '2022-07-28 09:52:31', '2022-07-28 09:52:31'),
(3, 'Buff Mo:Mo', 1, 160, '/food/momo/buff_momo.jpg', '2022-07-28 09:52:37', '2022-07-28 09:52:37'),
(4, 'Chicken C Mo:Mo', 1, 210, '/food/momo/c_momo.jpg', '2022-07-28 09:52:46', '2022-07-28 09:52:46'),
(5, 'Chicken Chowmein', 2, 140, '/food/chowmein/chicken_chowmein.jpg', '2022-07-28 09:53:06', '2022-07-28 09:53:06'),
(6, 'Veg Chowmein', 2, 110, '/food/chowmein/veg_chowmein.jpg', '2022-07-28 09:53:13', '2022-07-28 09:53:13'),
(7, 'Buff Chowmein', 2, 140, '/food/chowmein/buff_chowmein.jpg', '2022-07-28 09:53:21', '2022-07-28 09:53:21'),
(8, 'Chicken Burger', 3, 185, '/food/burger/chicken_burger.jpg', '2022-07-28 09:53:43', '2022-07-28 09:53:43'),
(9, 'HamBurger', 3, 140, '/food/burger/hamburger.jpg', '2022-07-28 09:53:53', '2022-07-28 09:53:53'),
(10, 'Chicken Mo:Mo (Fried)', 1, 200, '/food/momo/frymomo.jpg', '2022-07-29 14:50:29', '2022-07-29 14:50:29'),
(11, 'Chicken Sandwich', 4, 140, '/food/sandwich/chicken_sandwich.jpg', NULL, NULL),
(12, 'Tuna Sandwich', 4, 170, '/food/sandwich/tuna_sandwich.jpg\n', NULL, NULL),
(13, 'Veg Sandwich', 4, 110, '/food/sandwich/veg_sandwich.jpg\n', NULL, NULL),
(14, 'Buff Sandwich', 4, 160, '/food/sandwich/buff_sandwich.jpg\n', NULL, NULL),
(15, 'Veg Thukpa', 5, 70, '/food/thukpa/veg_thukpa.jpg\n', NULL, NULL),
(16, 'Egg Thukpa', 5, 100, '/food/thukpa/egg_thukpa.jpg\n', NULL, NULL),
(17, 'Buff Thupka', 5, 90, '/food/thukpa/buff_thukpa.jpg\n', '2022-07-29 10:30:42', '2022-07-29 10:30:42'),
(18, 'Chicken Thupka', 5, 110, '/food/thukpa/chicken_thukpa.jpg\n', '2022-07-29 10:30:42', '2022-07-29 10:30:42'),
(20, 'Cheese Pizza', 6, 220, '/food/pizza/cheese_pizza.jpg\n', '2022-07-29 10:32:03', '2022-07-29 10:32:03'),
(21, 'Chicken Pizza', 6, 190, '/food/pizza/chicken_pizza.jpg\n', '2022-07-29 10:32:03', '2022-07-29 10:32:03'),
(22, 'Pepperoni Pizza', 6, 300, '/food/pizza/pepperoni_pizza.jpg\n', '2022-07-29 10:32:03', '2022-07-29 10:32:03'),
(23, 'Mushroom Pizza', 6, 180, '/food/pizza/mushroom_pizza.jpg\n', '2022-07-29 10:32:03', '2022-07-29 10:32:03'),
(24, 'Samosa', 7, 25, '/food/snacks/samosa.jpg', '2022-07-29 10:34:56', '2022-07-29 10:34:56'),
(25, 'Pakauda', 7, 50, '/food/snacks/pakauda.jpg', '2022-07-29 10:34:56', '2022-07-29 10:34:56'),
(26, 'Chana ', 7, 30, '/food/snacks/chana.jpg', '2022-07-29 10:34:56', '2022-07-29 10:34:56'),
(27, 'Aalu Parotha ', 7, 60, '/food/snacks/aalo_paratha.jpg', '2022-07-29 10:34:56', '2022-07-29 10:34:56'),
(28, 'French Fries', 7, 120, '/food/snacks/french_fries.jpg', '2022-07-29 10:34:56', '2022-07-29 10:34:56'),
(29, 'Chicken Chilli', 7, 180, '/food/snacks/chicken_chilli.jpg', '2022-07-29 10:34:56', '2022-07-29 10:34:56'),
(30, 'Wai Wai Sadeko', 7, 150, '/food/snacks/waiwai.jpg', '2022-07-29 10:38:33', '2022-07-29 10:38:33'),
(31, 'Chicken Sausage', 7, 50, '/food/snacks/chicken_sausage.jpg', '2022-07-29 10:38:33', '2022-07-29 10:38:33'),
(32, 'Buff Sausage', 7, 70, '/food/snacks/buff_sausage.png', '2022-07-29 10:38:33', '2022-07-29 10:38:33'),
(33, 'Milk Tea', 8, 25, '/food/hot_drinks/milk_tea.jpg', '2022-07-29 10:39:41', '2022-07-29 10:39:41'),
(34, 'Black Tea', 8, 20, '/food/hot_drinks/black_tea.jpg', '2022-07-29 10:39:41', '2022-07-29 10:39:41'),
(35, 'Lemon Tea', 8, 25, '/food/hot_drinks/lemon_tea.jpg', '2022-07-29 10:39:41', '2022-07-29 10:39:41'),
(36, 'Milk Coffee', 8, 70, '/food/hot_drinks/milk_coffee.jpg', '2022-07-29 10:39:41', '2022-07-29 10:39:41'),
(37, 'Hot Lemon', 8, 25, '/food/hot_drinks/hot_lemon.jpg', '2022-07-29 10:39:41', '2022-07-29 10:39:41'),
(38, 'Dew/Coke/Sprite/Fanta', 9, 60, '/food/cold_drinks/drinks.jpg', '2022-07-29 10:43:18', '2022-07-29 10:43:18'),
(40, 'Real/Frooti', 9, 25, '/food/cold_drinks/frooti.jpg', '2022-07-29 10:43:18', '2022-07-29 10:43:18'),
(41, 'Red Bull', 9, 100, '/food/cold_drinks/redbull.jpg', '2022-07-29 10:43:18', '2022-07-29 10:43:18'),
(42, 'Lassi', 9, 80, '/food/cold_drinks/lassi.jpg', '2022-07-29 10:43:18', '2022-07-29 10:43:18');


INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dipen Chand', 'dipen@gmail.com', 'staff', NULL, '$2y$10$1yrVtjDgaSAe/CkOKMRLOurztERAT/m..sNPzqP55MNgWVobkqoZq', NULL, NULL, NULL),
(2, 'Ashim Neupane', 'ashim@gmail.com', 'admin', NULL, '$2y$10$1yrVtjDgaSAe/CkOKMRLOurztERAT/m..sNPzqP55MNgWVobkqoZq', NULL, NULL, NULL),
(3, 'Amar Neupane', 'amar@gmail.com', 'chef', NULL, '$2y$10$1yrVtjDgaSAe/CkOKMRLOurztERAT/m..sNPzqP55MNgWVobkqoZq', NULL, NULL, NULL);

```
