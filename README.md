# Caspian Industry Website

Full-featured industrial supplier website built with PHP, HTML, CSS, and JavaScript.

## Features

### Frontend
- ✅ Multi-language support (English, Russian, Azerbaijani)
- ✅ Dark theme with modern design
- ✅ Responsive layout for all devices
- ✅ Interactive 3D globe visualization
- ✅ Dynamic content management
- ✅ Contact form with validation
- ✅ News, Projects, Gallery, Partners, and FAQ sections

### Backend (Admin Panel)
- ✅ Secure authentication system
- ✅ Dashboard with statistics
- ✅ Contact form management
- ✅ News management (CRUD operations)
- ✅ Projects management with image uploads
- ✅ Gallery management
- ✅ Partners management
- ✅ FAQ management
- ✅ Site settings editor

## Technology Stack

- **Backend**: Pure PHP (no frameworks)
- **Database**: SQLite
- **Frontend**: HTML5, CSS3, JavaScript
- **3D Globe**: Globe.gl library
- **Icons**: Font Awesome 6
- **Fonts**: Inter

## Color Palette

The design uses colors extracted from the Caspian Industry logo:

- Primary Dark: `#0D293E`
- Primary: `#205581`
- Primary Light: `#3F6C96`
- Secondary: `#6BA8D6`
- Accent: `#A0BBD0`
- White: `#FEFEFE`
- Gray: `#778591`

## Installation

### Requirements
- PHP 7.4 or higher
- Apache web server with mod_rewrite
- SQLite support (usually included in PHP)

### Setup Steps

1. **Upload files** to your web server

2. **Set permissions** for the uploads directory:
```bash
chmod 777 assets/uploads
chmod 666 database/caspian_industry.db
```

3. **Configure Apache** - Make sure `.htaccess` is enabled

4. **Access the website**:
   - Frontend: `http://yourdomain.com`
   - Admin Panel: `http://yourdomain.com/admin`

5. **Default Admin Credentials**:
   - Username: `admin`
   - Password: `admin123`
   
   ⚠️ **IMPORTANT**: Change these credentials immediately after first login!

### Changing Admin Password

Edit `includes/config.php` and update:
```php
define('ADMIN_PASSWORD_HASH', password_hash('your_new_password', PASSWORD_DEFAULT));
```

## Project Structure

```
caspianindustry/
├── admin/                  # Admin panel
│   ├── contacts.php       # Contact forms management
│   ├── news.php           # News management
│   ├── projects.php       # Projects management
│   ├── gallery.php        # Gallery management
│   ├── partners.php       # Partners management
│   ├── faq.php            # FAQ management
│   ├── settings.php       # Site settings
│   └── ...
├── assets/
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   ├── images/            # Static images
│   └── uploads/           # User uploaded files
├── database/
│   └── caspian_industry.db # SQLite database
├── includes/
│   ├── config.php         # Configuration
│   ├── database.php       # Database connection
│   ├── language.php       # Multi-language system
│   ├── header.php         # Site header
│   ├── footer.php         # Site footer
│   └── contact-handler.php # Contact form handler
├── languages/
│   ├── en.json            # English translations
│   ├── ru.json            # Russian translations
│   └── az.json            # Azerbaijani translations
├── pages/
│   ├── about.php          # About page
│   ├── news.php           # News listing
│   ├── news-detail.php    # News detail
│   ├── projects.php       # Projects listing
│   ├── project-detail.php # Project detail
│   ├── gallery.php        # Gallery
│   ├── partners.php       # Partners
│   ├── contact.php        # Contact page
│   └── faq.php            # FAQ page
├── index.php              # Homepage
├── .htaccess              # Apache configuration
└── README.md              # This file
```

## Database Structure

The SQLite database includes the following tables:

- `contacts` - Contact form submissions
- `news` - News articles (multilingual)
- `projects` - Project portfolio (multilingual)
- `gallery` - Image gallery
- `partners` - Partner logos and information
- `faq` - FAQ items (multilingual)
- `site_settings` - Site configuration

All content tables support three languages (EN, RU, AZ).

## Adding Content

### Via Admin Panel (Recommended)

1. Login to admin panel at `/admin`
2. Navigate to the relevant section
3. Click "Add New" button
4. Fill in the form for all three languages
5. Upload images if needed
6. Save

### Via Database (Advanced)

You can also directly edit the SQLite database using tools like:
- SQLite Browser (GUI)
- Command line SQLite tools

## Customization

### Adding a New Language

1. Create new translation file in `languages/` (e.g., `de.json`)
2. Add language code to `AVAILABLE_LANGS` in `includes/config.php`
3. Add database columns for new language (e.g., `title_de`, `content_de`)
4. Update language switcher in `includes/header.php`

### Changing Colors

Edit CSS variables in `assets/css/style.css`:
```css
:root {
    --color-primary: #205581;
    --color-secondary: #6BA8D6;
    /* ... etc */
}
```

### Modifying Globe Locations

Edit the locations array in `index.php` and `pages/about.php`:
```javascript
const locations = [
    { lat: 40.4093, lng: 49.8671, name: 'BAKU' },
    // Add more locations...
];
```

## Security Considerations

- Change default admin credentials
- Use HTTPS in production (uncomment in `.htaccess`)
- Regular database backups
- Keep PHP updated
- Validate and sanitize all user inputs
- Use prepared statements for database queries

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## License

Proprietary - All rights reserved by Caspian Industry

## Support

For support or questions, contact: info@caspianindustry.com

---

Built with ❤️ for Caspian Industry
