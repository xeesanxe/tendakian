# Image replacement instructions

This project currently uses Unsplash placeholder images for outdoor rental gear. To replace placeholders with your own images, follow these steps:

1. Prepare images
   - Recommended sizes: product thumbnails ~600x400, hero images 1200x700.
   - Optimize images for web (JPEG/WEBP) and keep filenames short (e.g., `tent.jpg`).

2. Place images in the public `assets/images` folder
   - Put images in `public/assets/images/` for static assets.
   - For product images that are uploaded per-product, store in `storage/app/public/products` and run `php artisan storage:link`.

3. Update templates
   - Static replacement: change the `src` URL in templates under `resources/views/` from the Unsplash URL to `{{ asset('assets/images/your-image.jpg') }}`.
   - Dynamic product images: if you store product images in the database, set the `image` field to the relative path (e.g., `products/tent.jpg`) and ensure the templates use `asset('storage/'.$product->image)`.

4. (Optional) Seed sample images
   - Update `database/seeders/` to set a sample `image` path for `products` so that seeded products show real images.

5. Rebuild/clear cache

```bash
php artisan storage:link
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

6. Notes
   - The current placeholders are external URLs (Unsplash). When using local files, ensure the filenames and storage path match the templates.
   - For consistent look, categorize images by keywords: `camping`, `tent`, `backpack`, `stove`, `sleeping-bag`.

If you want, I can:
- Replace all placeholders with sample images saved in `public/assets/images/` (I will add them), or
- Add a `products.image` column and a small upload form in admin to manage images.

Reply which option you prefer and I'll proceed.