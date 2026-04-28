<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SiteSettingSeeder::class,
            SeoSeeder::class,
            ShipDistrictSeeder::class,
            ShipCitySeeder::class,
            ShipStateSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            MultiImgSeeder::class,
            SliderSeeder::class,
            BannerSeeder::class,
            CoupounSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            WishlistSeeder::class,
            CompareSeeder::class,
            ReviewSeeder::class,
            BlogCategorySeeder::class,
            BlogPostSeeder::class,
            BlogCommentSeeder::class,
        ]);
    }
}
