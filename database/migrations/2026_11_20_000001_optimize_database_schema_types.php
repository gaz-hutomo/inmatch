<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Optimize `users`
        DB::statement("ALTER TABLE `users` MODIFY COLUMN `status` ENUM('pending', 'approved', 'banned') NOT NULL DEFAULT 'pending';");

        // 2. Drop FK constraints pointing to categories.id before altering its data type
        try {
            DB::statement("ALTER TABLE `category_profile` DROP FOREIGN KEY `category_profile_category_id_foreign`;");
        } catch (\Exception $e) {}
        try {
            DB::statement("ALTER TABLE `profiles` DROP FOREIGN KEY `profiles_primary_category_id_foreign`;");
        } catch (\Exception $e) {}
        try {
            DB::statement("ALTER TABLE `profiles` DROP FOREIGN KEY `profiles_secondary_category_id_foreign`;");
        } catch (\Exception $e) {}

        // 3. Optimize `categories`
        DB::statement("ALTER TABLE `categories` MODIFY COLUMN `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT;");
        DB::statement("ALTER TABLE `categories` MODIFY COLUMN `name` VARCHAR(50) NOT NULL;");

        // 4. Optimize `profiles`
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `avatar` VARCHAR(150) NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `city` VARCHAR(60) NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `min_price` DECIMAL(12, 0) NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `max_price` DECIMAL(12, 0) NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `primary_category_id` TINYINT UNSIGNED NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `secondary_category_id` TINYINT UNSIGNED NULL;");

        // 5. Optimize `category_profile` pivot table (drop id, make composite PK, alter category_id)
        if (Schema::hasColumn('category_profile', 'id')) {
            try {
                DB::statement("ALTER TABLE `category_profile` DROP INDEX `category_profile_profile_id_category_id_unique`;");
            } catch (\Exception $e) {}

            DB::statement("ALTER TABLE `category_profile` DROP PRIMARY KEY, DROP COLUMN `id`;");
            DB::statement("ALTER TABLE `category_profile` MODIFY COLUMN `category_id` TINYINT UNSIGNED NOT NULL;");
            DB::statement("ALTER TABLE `category_profile` ADD PRIMARY KEY (`profile_id`, `category_id`);");
        } else {
            DB::statement("ALTER TABLE `category_profile` MODIFY COLUMN `category_id` TINYINT UNSIGNED NOT NULL;");
        }

        // Re-attach FK constraints to categories
        try {
            DB::statement("ALTER TABLE `category_profile` ADD CONSTRAINT `category_profile_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE;");
        } catch (\Exception $e) {}
        try {
            DB::statement("ALTER TABLE `profiles` ADD CONSTRAINT `profiles_primary_category_id_foreign` FOREIGN KEY (`primary_category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT;");
        } catch (\Exception $e) {}
        try {
            DB::statement("ALTER TABLE `profiles` ADD CONSTRAINT `profiles_secondary_category_id_foreign` FOREIGN KEY (`secondary_category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT;");
        } catch (\Exception $e) {}

        // 6. Optimize `endorsements`
        DB::statement("ALTER TABLE `endorsements` MODIFY COLUMN `status` ENUM('pending', 'accepted', 'rejected', 'completed') NOT NULL DEFAULT 'pending';");
        DB::statement("ALTER TABLE `endorsements` MODIFY COLUMN `offered_price` DECIMAL(12, 0) NOT NULL;");

        // 7. Optimize `chat_messages`
        DB::statement("ALTER TABLE `chat_messages` MODIFY COLUMN `attachment_type` ENUM('image', 'video') NULL;");
        DB::statement("ALTER TABLE `chat_messages` MODIFY COLUMN `attachment_path` VARCHAR(150) NULL;");

        // 8. Optimize `ratings`
        DB::statement("ALTER TABLE `ratings` MODIFY COLUMN `score` TINYINT UNSIGNED NOT NULL;");

        // 9. Optimize `dynamic_backgrounds`
        DB::statement("ALTER TABLE `dynamic_backgrounds` MODIFY COLUMN `type` ENUM('image', 'emoji', 'shape') NOT NULL DEFAULT 'image';");
        DB::statement("ALTER TABLE `dynamic_backgrounds` MODIFY COLUMN `content` VARCHAR(150) NOT NULL;");

        // 10. Optimize & Enhance `reports`
        if (!Schema::hasColumn('reports', 'endorsement_id')) {
            DB::statement("ALTER TABLE `reports` ADD COLUMN `endorsement_id` BIGINT UNSIGNED NULL AFTER `reported_id`;");
            DB::statement("ALTER TABLE `reports` ADD CONSTRAINT `reports_endorsement_id_foreign` FOREIGN KEY (`endorsement_id`) REFERENCES `endorsements`(`id`) ON DELETE SET NULL;");
        }
        DB::statement("ALTER TABLE `reports` MODIFY COLUMN `status` ENUM('pending', 'reviewed', 'resolved') NOT NULL DEFAULT 'pending';");
        DB::statement("ALTER TABLE `reports` MODIFY COLUMN `reason` VARCHAR(100) NOT NULL;");
        DB::statement("ALTER TABLE `reports` MODIFY COLUMN `proof_path` VARCHAR(150) NULL;");

        // 11. Optimize `settings`
        DB::statement("ALTER TABLE `settings` MODIFY COLUMN `key` VARCHAR(60) NOT NULL;");

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        try {
            DB::statement("ALTER TABLE `category_profile` DROP FOREIGN KEY `category_profile_category_id_foreign`;");
        } catch (\Exception $e) {}
        try {
            DB::statement("ALTER TABLE `profiles` DROP FOREIGN KEY `profiles_primary_category_id_foreign`;");
        } catch (\Exception $e) {}
        try {
            DB::statement("ALTER TABLE `profiles` DROP FOREIGN KEY `profiles_secondary_category_id_foreign`;");
        } catch (\Exception $e) {}

        DB::statement("ALTER TABLE `users` MODIFY COLUMN `status` VARCHAR(255) NOT NULL DEFAULT 'pending';");
        DB::statement("ALTER TABLE `categories` MODIFY COLUMN `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT;");
        DB::statement("ALTER TABLE `categories` MODIFY COLUMN `name` VARCHAR(255) NOT NULL;");

        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `avatar` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `city` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `min_price` DECIMAL(15, 2) NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `max_price` DECIMAL(15, 2) NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `primary_category_id` BIGINT UNSIGNED NULL;");
        DB::statement("ALTER TABLE `profiles` MODIFY COLUMN `secondary_category_id` BIGINT UNSIGNED NULL;");

        DB::statement("ALTER TABLE `category_profile` MODIFY COLUMN `category_id` BIGINT UNSIGNED NOT NULL;");

        try {
            DB::statement("ALTER TABLE `category_profile` ADD CONSTRAINT `category_profile_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE;");
        } catch (\Exception $e) {}

        DB::statement("ALTER TABLE `endorsements` MODIFY COLUMN `status` VARCHAR(255) NOT NULL DEFAULT 'pending';");
        DB::statement("ALTER TABLE `endorsements` MODIFY COLUMN `offered_price` DECIMAL(15, 2) NOT NULL;");

        DB::statement("ALTER TABLE `chat_messages` MODIFY COLUMN `attachment_type` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE `chat_messages` MODIFY COLUMN `attachment_path` VARCHAR(255) NULL;");

        DB::statement("ALTER TABLE `ratings` MODIFY COLUMN `score` INT NOT NULL;");

        DB::statement("ALTER TABLE `dynamic_backgrounds` MODIFY COLUMN `type` VARCHAR(255) NOT NULL;");
        DB::statement("ALTER TABLE `dynamic_backgrounds` MODIFY COLUMN `content` VARCHAR(255) NOT NULL;");

        DB::statement("ALTER TABLE `reports` MODIFY COLUMN `status` VARCHAR(255) NOT NULL DEFAULT 'pending';");
        DB::statement("ALTER TABLE `reports` MODIFY COLUMN `reason` VARCHAR(255) NOT NULL;");
        DB::statement("ALTER TABLE `reports` MODIFY COLUMN `proof_path` VARCHAR(255) NULL;");

        DB::statement("ALTER TABLE `settings` MODIFY COLUMN `key` VARCHAR(255) NOT NULL;");

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
