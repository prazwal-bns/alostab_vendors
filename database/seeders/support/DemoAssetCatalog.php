<?php

namespace Database\Seeders\Support;

final class DemoAssetCatalog
{
    public const SITE_LOGO = 'frontend/assets/imgs/theme/logo.svg';

    private const ADMIN_PRODUCTS = 'adminbackend/assets/images/products';

    private const ADMIN_GALLERY = 'adminbackend/assets/images/gallery';

    private const ADMIN_ICONS = 'adminbackend/assets/images/icons';

    private const ADMIN_AVATARS = 'adminbackend/assets/images/avatars';

    private const FRONTEND_SHOP = 'frontend/assets/imgs/shop';

    private const FRONTEND_SLIDER = 'frontend/assets/imgs/slider';

    private const FRONTEND_BANNER = 'frontend/assets/imgs/banner';

    private const FRONTEND_BLOG = 'frontend/assets/imgs/blog';

    private const FRONTEND_VENDOR = 'frontend/assets/imgs/vendor';

    /** @var list<string> */
    private const BRAND_ICONS = [
        'chair.png',
        'tshirt.png',
        'shoes.png',
        'watch.png',
        'headphones.png',
    ];

    /**
     * Curated products keyed by image number (01–19).
     *
     * @return list<array{
     *     number: int,
     *     product_name: string,
     *     category: string,
     *     product_tags: string,
     *     selling_price: int,
     *     short_desc: string,
     * }>
     */
    public static function curatedProducts(): array
    {
        return [
            [
                'number' => 1,
                'product_name' => 'Modern Contoured Dining Chair',
                'category' => 'Home & Kitchen',
                'product_tags' => 'furniture,chair,dining,modern',
                'selling_price' => 8990,
                'short_desc' => 'Sleek matte black molded seat with chrome legs in a mid-century silhouette.',
            ],
            [
                'number' => 2,
                'product_name' => 'Rustic 5-Piece Dining Set',
                'category' => 'Home & Kitchen',
                'product_tags' => 'furniture,dining,set,rustic',
                'selling_price' => 45900,
                'short_desc' => 'Solid wood table with four ladder-back chairs in a warm honey finish.',
            ],
            [
                'number' => 3,
                'product_name' => 'Ruby Modern Loveseat',
                'category' => 'Home & Kitchen',
                'product_tags' => 'sofa,living-room,fabric,modern',
                'selling_price' => 32500,
                'short_desc' => 'Two-seater fabric sofa with floral accent pillows in vibrant red.',
            ],
            [
                'number' => 4,
                'product_name' => 'Magenta Swan Designer Sofa',
                'category' => 'Home & Kitchen',
                'product_tags' => 'sofa,designer,modern,statement',
                'selling_price' => 54900,
                'short_desc' => 'Curved organic loveseat with brushed metal base in bold magenta.',
            ],
            [
                'number' => 5,
                'product_name' => 'Classic Extendable Dining Table',
                'category' => 'Home & Kitchen',
                'product_tags' => 'table,dining,wood,extendable',
                'selling_price' => 38900,
                'short_desc' => 'Honey oak rectangular table with tapered legs and extendable center leaf.',
            ],
            [
                'number' => 6,
                'product_name' => 'Classic Bentwood Bistro Chair',
                'category' => 'Home & Kitchen',
                'product_tags' => 'chair,bistro,bentwood,vintage',
                'selling_price' => 6490,
                'short_desc' => 'Steam-bent dark wood cafe chair with a circular seat and curved backrest.',
            ],
            [
                'number' => 7,
                'product_name' => 'Two-Tone Brown Beige Loveseat',
                'category' => 'Home & Kitchen',
                'product_tags' => 'sofa,living-room,leather,fabric',
                'selling_price' => 29800,
                'short_desc' => 'Contemporary loveseat with brown frame, beige cushions, and floral pillows.',
            ],
            [
                'number' => 8,
                'product_name' => 'Modern Round Pedestal Table',
                'category' => 'Home & Kitchen',
                'product_tags' => 'table,pedestal,modern,cafe',
                'selling_price' => 12400,
                'short_desc' => 'Minimalist round table with chrome pedestal base and light gray top.',
            ],
            [
                'number' => 9,
                'product_name' => 'Executive Wooden Office Desk',
                'category' => 'Home & Kitchen',
                'product_tags' => 'desk,office,furniture,storage',
                'selling_price' => 41500,
                'short_desc' => 'Polished wood executive desk with cabinet, drawers, and keyboard shelf.',
            ],
            [
                'number' => 10,
                'product_name' => 'Farmhouse Upholstered Dining Chair',
                'category' => 'Home & Kitchen',
                'product_tags' => 'chair,dining,farmhouse,upholstered',
                'selling_price' => 7890,
                'short_desc' => 'Cream ladder-back chair with padded beige tweed seat cushion.',
            ],
            [
                'number' => 11,
                'product_name' => 'Scott Essential Crew Neck T-Shirt',
                'category' => 'Fashion',
                'product_tags' => 'apparel,tshirt,men,cyan',
                'selling_price' => 1890,
                'short_desc' => 'Bright cyan cotton tee with Scott chest logo and ribbed crew neck.',
            ],
            [
                'number' => 12,
                'product_name' => 'Basic Green Crew Neck T-Shirt',
                'category' => 'Fashion',
                'product_tags' => 'apparel,tshirt,basic,green',
                'selling_price' => 1290,
                'short_desc' => 'Plain vibrant green short-sleeve tee for everyday casual wear.',
            ],
            [
                'number' => 13,
                'product_name' => 'White Ringer T-Shirt',
                'category' => 'Fashion',
                'product_tags' => 'apparel,tshirt,ringer,white',
                'selling_price' => 1490,
                'short_desc' => 'Classic white ringer tee with contrasting dark sleeve cuffs.',
            ],
            [
                'number' => 14,
                'product_name' => 'Bright Yellow Crew Neck T-Shirt',
                'category' => 'Fashion',
                'product_tags' => 'apparel,tshirt,basic,yellow',
                'selling_price' => 1290,
                'short_desc' => 'Soft cotton crew neck tee in a vibrant sunflower yellow.',
            ],
            [
                'number' => 15,
                'product_name' => 'Coral Crew Neck T-Shirt',
                'category' => 'Fashion',
                'product_tags' => 'apparel,tshirt,basic,coral',
                'selling_price' => 1290,
                'short_desc' => 'Comfortable coral short-sleeve tee with a classic rounded neckline.',
            ],
            [
                'number' => 16,
                'product_name' => 'Premium Silver Over-Ear Headphones',
                'category' => 'Electronics',
                'product_tags' => 'audio,headphones,wired,electronics',
                'selling_price' => 8900,
                'short_desc' => 'Wired over-ear headphones with metallic silver finish and padded earcups.',
            ],
            [
                'number' => 17,
                'product_name' => 'iPhone 5 Smartphone 16GB',
                'category' => 'Electronics',
                'product_tags' => 'phone,apple,smartphone,mobile',
                'selling_price' => 19900,
                'short_desc' => 'Compact Apple smartphone with 4-inch Retina display in slate black.',
            ],
            [
                'number' => 18,
                'product_name' => 'iPhone 6 Gold 64GB',
                'category' => 'Electronics',
                'product_tags' => 'phone,apple,smartphone,gold',
                'selling_price' => 29900,
                'short_desc' => 'Gold finish iPhone with 4.7-inch Retina HD display and Touch ID.',
            ],
            [
                'number' => 19,
                'product_name' => 'Stainless Steel Smartwatch',
                'category' => 'Electronics',
                'product_tags' => 'watch,smartwatch,wearable,electronics',
                'selling_price' => 24900,
                'short_desc' => 'Silver link-band smartwatch with analog-style display and date window.',
            ],
        ];
    }

    public static function productImage(int $number): string
    {
        $n = max(1, min(19, $number));

        return self::ADMIN_PRODUCTS . '/' . str_pad((string) $n, 2, '0', STR_PAD_LEFT) . '.png';
    }

    public static function galleryImage(int $number): string
    {
        $n = (($number - 1) % 34) + 1;

        return self::ADMIN_GALLERY . '/' . str_pad((string) $n, 2, '0', STR_PAD_LEFT) . '.png';
    }

    public static function categoryImage(int $index): string
    {
        $n = (($index - 1) % 16) + 1;

        return self::FRONTEND_SHOP . '/cat-' . $n . '.png';
    }

    public static function brandImage(int $index): string
    {
        $icon = self::BRAND_ICONS[($index - 1) % count(self::BRAND_ICONS)];

        return self::ADMIN_ICONS . '/' . $icon;
    }

    public static function sliderImage(int $index): string
    {
        $n = (($index - 1) % 8) + 1;

        return self::FRONTEND_SLIDER . '/slider-' . $n . '.png';
    }

    public static function bannerImage(int $index): string
    {
        $n = (($index - 1) % 19) + 1;

        return self::FRONTEND_BANNER . '/banner-' . $n . '.png';
    }

    public static function blogImage(int $index): string
    {
        $n = (($index - 1) % 21) + 1;

        return self::FRONTEND_BLOG . '/blog-' . $n . '.png';
    }

    public static function avatarFilename(int $index): string
    {
        $n = (($index - 1) % 25) + 1;

        return 'avatar-' . $n . '.png';
    }

    public static function vendorFilename(int $index): string
    {
        $n = (($index - 1) % 17) + 1;

        return 'vendor-' . $n . '.png';
    }

    public static function avatarSourcePath(int $index): string
    {
        return self::ADMIN_AVATARS . '/' . self::avatarFilename($index);
    }

    public static function vendorSourcePath(int $index): string
    {
        return self::FRONTEND_VENDOR . '/' . self::vendorFilename($index);
    }

    /**
     * @return list<string>
     */
    public static function multiImagesForProduct(int $productNumber, int $productId): array
    {
        return [
            self::productImage($productNumber),
            self::galleryImage($productId),
            self::galleryImage($productId + 7),
        ];
    }
}
