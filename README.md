# 🥬 LeafMart - Fresh & Organic Groceries

A modern, mobile-friendly grocery shopping website built with PHP, featuring an organic, farm-fresh design aesthetic. Browse seasonal produce, manage your cart, and enjoy a clean, intuitive shopping experience.

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-purple.svg)

## ✨ Features

### 🛒 Shopping Experience
- **Product Catalog** - Browse fresh fruits, vegetables, and organic items
- **Advanced Filtering** - Filter by category, tags, price range, and availability
- **Search Functionality** - Quick product search with real-time results
- **Shopping Cart** - Add/remove items with persistent storage using localStorage
- **Wishlist** - Save favorite items for later
- **Seasonal Offers** - Featured deals and limited-time products

### 🎨 Design & UX
- **Mobile-First Design** - Optimized for smartphones and tablets
- **Responsive Layout** - Seamless experience across all devices
- **Clean UI** - Minimal, modern interface with farm-fresh aesthetics
- **Toast Notifications** - Elegant feedback for user actions
- **Smooth Animations** - Polished interactions and transitions
- **Accessible** - ARIA labels and semantic HTML

### 👤 User Features
- **User Authentication** - Login/signup modal system
- **Account Management** - User profile and order history
- **Guest Checkout** - Shop without creating an account
- **Newsletter Subscription** - Stay updated with seasonal deals

### 📄 Pages
- **Home** - Hero section, featured categories, seasonal offers, testimonials
- **Shop** - Full product catalog with filtering and sorting
- **Product Detail** - Detailed product information and reviews
- **Cart** - Review items and manage quantities
- **Checkout** - Complete purchase with delivery details
- **About** - Company information and values
- **Contact** - Get in touch and find locations
- **FAQ** - Common questions and answers
- **Account** - User profile and order management
- **Admin** - Product and order management (demo)

## 🚀 Getting Started

### Prerequisites
- PHP 8.0 or higher
- Web server (Apache, Nginx, or PHP built-in server)
- Modern web browser

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/grocery-shop.git
   cd grocery-shop
   ```

2. **Start the development server**
   
   Using PHP built-in server:
   ```bash
   php -S localhost:8000
   ```
   
   Or configure your web server to point to the project directory.

3. **Open in browser**
   ```
   http://localhost:8000
   ```

### Project Structure

```
grocery-shop/
├── assets/
│   ├── css/
│   │   └── style.css          # Main stylesheet
│   ├── images/
│   │   ├── categories/        # Category images
│   │   └── products/          # Product images
│   └── js/
│       └── main.js            # Core JavaScript functionality
├── components/
│   └── product-card.php       # Reusable product card component
├── includes/
│   ├── config.php             # Configuration and demo data
│   ├── header.php             # Site header
│   ├── footer.php             # Site footer
│   ├── navigation.php         # Navigation menu
│   └── auth-modal.php         # Login/signup modal
├── index.php                  # Homepage
├── shop.php                   # Product listing page
├── product-detail.php         # Product detail page
├── cart.php                   # Shopping cart
├── checkout.php               # Checkout page
├── account.php                # User account page
├── admin.php                  # Admin dashboard
├── about.php                  # About page
├── contact.php                # Contact page
├── faq.php                    # FAQ page
├── privacy.php                # Privacy policy
└── terms.php                  # Terms of service
```

## 🔧 Configuration

### Site Settings
Edit `includes/config.php` to customize:

```php
const SITE_NAME = 'LeafMart';
const SITE_TAGLINE = 'Fresh & Organic Groceries';
const SHOP_CURRENCY_SYMBOL = '৳';
```

### Demo Data
The site currently uses demo data stored in `includes/config.php`. The `demo_products()` function returns an array of sample products.

**For production use:**
- Replace demo data with database queries
- Implement proper backend API
- Add authentication and session management
- Integrate payment gateway

## 🛠️ Technology Stack

- **Frontend:**
  - HTML5 (semantic markup)
  - CSS3 (custom properties, grid, flexbox)
  - Vanilla JavaScript (ES6+)
  - No external dependencies or frameworks

- **Backend:**
  - PHP 8.0+ (strict types)
  - No database (demo data only)

- **Storage:**
  - localStorage for cart and wishlist
  - Session-based authentication (demo)

## 🎯 Key Features Explained

### Cart Management
The cart uses localStorage for persistence:
```javascript
window.LeafMart.addToCart(productId, quantity)
window.LeafMart.removeFromCart(productId)
window.LeafMart.updateCartItem(productId, newQuantity)
```

### Product Filtering
Shop page supports multiple filter types:
- Category (Fruits, Vegetables)
- Tags (Organic, Seasonal)
- Price range
- Availability (In stock, On sale)
- Search query

### Responsive Design
- Mobile menu with smooth slide-in animation
- Touch-friendly buttons and interactions
- Optimized images with srcset
- Flexible grid layouts

## 🎨 Design Philosophy

LeafMart features a distinctive organic aesthetic:
- **Color Palette:** Earthy greens, warm accents
- **Typography:** Clean, readable fonts
- **Imagery:** High-quality product photos
- **Spacing:** Generous whitespace
- **Components:** Card-based design with soft shadows

## 📱 Mobile Optimization

- Touch-optimized buttons and inputs
- Swipeable product sliders
- Collapsible mobile menu
- Optimized images for faster loading
- Mobile-friendly checkout flow

## 🔐 Security Notes

**Current Implementation (Demo):**
- No actual authentication
- No database
- Client-side storage only

**For Production:**
- Implement server-side sessions
- Use prepared statements for database queries
- Hash passwords with bcrypt
- Add CSRF protection
- Sanitize all user inputs
- Implement rate limiting
- Use HTTPS

## 🚧 Future Enhancements

- [ ] Database integration (MySQL/PostgreSQL)
- [ ] User authentication and authorization
- [ ] Payment gateway integration
- [ ] Order management system
- [ ] Email notifications
- [ ] Product reviews and ratings
- [ ] Inventory management
- [ ] Admin dashboard with analytics
- [ ] Multi-language support
- [ ] Advanced search with autocomplete
- [ ] Product recommendations
- [ ] Delivery tracking

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👨‍💻 Author

Your Name - [Your GitHub Profile](https://github.com/yourusername)

## 🙏 Acknowledgments

- Product images from Unsplash
- Icons and emoji for visual elements
- Inspiration from modern e-commerce designs

## 📞 Support

For support, email support@leafmart.com or open an issue on GitHub.

---

**Note:** This is a demonstration project with mock data. For production use, implement proper backend infrastructure, security measures, and database integration.
