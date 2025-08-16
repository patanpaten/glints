# Glints - Comprehensive Job Portal Application

A full-featured job portal application built with Laravel, featuring advanced hiring tools, analytics, and premium features.

## 🚀 Features

### Core Features
- **User Authentication & Role Management**
  - Admin, Company, and Job Seeker roles
  - Secure login/registration system
  - Role-based access control

- **Job Management**
  - Post, edit, and manage job listings
  - Job categories and skills matching
  - Featured and active job status
  - Advanced job search and filtering

- **Application System**
  - Job application submission
  - Application status tracking
  - Resume upload and management
  - Cover letter support

### Advanced Features

#### 💬 Chat System
- Real-time communication between companies and job seekers
- Chat interface for CV viewing and application discussions
- Message history and read status tracking
- Quick actions for application management

#### 🔍 CV Search
- Advanced candidate search with multiple filters
- Skills-based matching algorithm
- Experience and education level filtering
- Location-based search
- Match score calculation
- Search history and saved searches

#### 📊 Analytics Dashboard
- Comprehensive job performance metrics
- Interactive charts and graphs
- Job view and application tracking
- Conversion rate analysis
- Export functionality (CSV/JSON)
- Company performance insights

#### ⭐ Premium Features
- Subscription-based feature access
- Multiple pricing tiers (Basic, Professional, Enterprise)
- Advanced hiring tools
- Priority support
- Enhanced analytics and reporting

#### 🏢 Company Dashboard
- Job posting management
- Application tracking
- Candidate management
- Performance analytics
- Premium feature access

#### 👤 Job Seeker Dashboard
- Profile management
- Education and experience tracking
- Skills management
- Application history
- Saved jobs
- Profile completion tracking

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x
- **Database**: MySQL/PostgreSQL
- **Frontend**: Bootstrap 5, Chart.js
- **Authentication**: Laravel Breeze
- **File Upload**: Laravel Storage
- **Charts**: Chart.js for analytics

## 📋 Requirements

- PHP 8.1+
- Composer
- MySQL 5.7+ or PostgreSQL 10+
- Node.js & NPM (for frontend assets)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd glints
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   ```bash
   # Update .env with your database credentials
   php artisan migrate
   php artisan db:seed
   ```

5. **Storage setup**
   ```bash
   php artisan storage:link
   ```

6. **Start the application**
   ```bash
   php artisan serve
   npm run dev
   ```

## 🗄️ Database Structure

### Core Tables
- `users` - User accounts and authentication
- `roles` - User role definitions
- `companies` - Company profiles
- `job_seekers` - Job seeker profiles
- `jobs` - Job listings
- `applications` - Job applications
- `skills` - Skills database
- `job_categories` - Job categories

### Feature Tables
- `chat_messages` - Chat system messages
- `premium_features` - Premium feature definitions
- `company_subscriptions` - Company subscriptions
- `job_analytics` - Job performance metrics
- `company_analytics` - Company performance metrics
- `cv_searches` - CV search history
- `cv_search_results` - CV search results

## 🔐 User Roles

### Admin
- Full system access
- User management
- Premium feature management
- System analytics
- Content moderation

### Company
- Job posting and management
- Application review
- CV search (premium)
- Analytics dashboard
- Premium features access

### Job Seeker
- Profile management
- Job applications
- Job search and saving
- Skills and education tracking

## 💰 Premium Features

### Basic Plan ($29.99/month)
- Up to 5 active job postings
- Basic analytics dashboard
- Email support
- Standard job templates

### Professional Plan ($79.99/month)
- Up to 20 active job postings
- Advanced analytics with charts
- CV search functionality
- Priority support
- Custom job templates
- Job promotion features
- Applicant tracking system

### Enterprise Plan ($199.99/month)
- Unlimited job postings
- Full analytics suite
- Advanced CV search with AI matching
- Dedicated account manager
- Custom integrations
- White-label options
- Advanced reporting
- Bulk operations
- API access

## 📱 Key Routes

### Public Routes
- `/` - Home page
- `/jobs` - Job listings
- `/login` - User login
- `/register` - User registration
- `/premium-features` - Premium features showcase

### Company Routes
- `/company/dashboard` - Company dashboard
- `/company/jobs` - Job management
- `/company/applications` - Application management
- `/company/cv-search` - CV search
- `/company/analytics` - Analytics dashboard
- `/company/premium-features` - Premium features

### Job Seeker Routes
- `/jobseeker/dashboard` - Job seeker dashboard
- `/jobseeker/profile` - Profile management
- `/jobseeker/applications` - Application history
- `/jobseeker/saved-jobs` - Saved jobs

### Admin Routes
- `/admin/dashboard` - Admin dashboard
- `/admin/premium-features` - Premium feature management
- `/admin/analytics` - System analytics

### Chat Routes
- `/chat/{applicationId}` - Chat interface
- `/chat/{applicationId}/send` - Send message

## 🔧 Configuration

### File Upload
Configure file upload settings in `config/filesystems.php`:
```php
'uploads' => [
    'driver' => 'local',
    'root' => storage_path('app/public/uploads'),
    'url' => env('APP_URL').'/storage/uploads',
    'visibility' => 'public',
],
```

### Premium Features
Configure premium feature settings in `config/premium.php`:
```php
'features' => [
    'cv_search' => ['min_plan' => 'professional'],
    'advanced_analytics' => ['min_plan' => 'professional'],
    'unlimited_jobs' => ['min_plan' => 'enterprise'],
],
```

## 📊 Analytics Features

### Job Analytics
- View counts and unique views
- Application conversion rates
- Job performance metrics
- Geographic distribution
- Time-based trends

### Company Analytics
- Overall company performance
- Job posting effectiveness
- Candidate engagement metrics
- ROI analysis
- Export capabilities

## 🔍 CV Search Features

### Search Filters
- Keywords and job titles
- Skills matching
- Experience level
- Education requirements
- Location preferences
- Job category

### Matching Algorithm
- Skills-based scoring
- Experience weighting
- Education level matching
- Location relevance
- Profile completeness bonus

## 💬 Chat System Features

### Communication
- Real-time messaging
- Application context
- File sharing support
- Read receipts
- Conversation history

### Quick Actions
- Application status updates
- Profile viewing
- Resume download
- Application withdrawal

## 🚀 Deployment

### Production Setup
1. Set environment to production
2. Configure database for production
3. Set up proper file storage
4. Configure caching
5. Set up queue workers
6. Configure SSL certificates

### Performance Optimization
- Enable route caching
- Configure database indexing
- Set up Redis for caching
- Optimize file storage
- Configure CDN for assets

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the documentation

## 🔄 Updates

### Version 2.0
- Added comprehensive chat system
- Implemented CV search functionality
- Added analytics dashboard
- Introduced premium features
- Enhanced user experience
- Improved performance and security

---

**Built with ❤️ using Laravel**
