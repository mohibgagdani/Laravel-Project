# Database Schema Documentation

## Tables Overview

### 1. users
Stores user information for both admin and regular users.

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| name | VARCHAR(255) | User's full name |
| email | VARCHAR(255) | Unique email address |
| password | VARCHAR(255) | Hashed password |
| role | ENUM('admin', 'user') | User role (default: 'user') |
| email_verified_at | TIMESTAMP | Email verification timestamp |
| remember_token | VARCHAR(100) | Remember me token |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |

**Indexes:**
- PRIMARY KEY (id)
- UNIQUE (email)

---

### 2. authors
Stores author information.

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| name | VARCHAR(255) | Author's name |
| bio | TEXT | Author's biography (nullable) |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |

**Indexes:**
- PRIMARY KEY (id)

**Relationships:**
- Has many books

---

### 3. categories
Stores book categories.

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| name | VARCHAR(255) | Category name (unique) |
| description | TEXT | Category description (nullable) |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |

**Indexes:**
- PRIMARY KEY (id)
- UNIQUE (name)

**Relationships:**
- Has many books

---

### 4. books
Stores book information.

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| title | VARCHAR(255) | Book title |
| isbn | VARCHAR(255) | ISBN number (unique) |
| author_id | BIGINT | Foreign key to authors table |
| category_id | BIGINT | Foreign key to categories table |
| quantity | INTEGER | Total quantity of books |
| available_quantity | INTEGER | Currently available quantity |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |

**Indexes:**
- PRIMARY KEY (id)
- UNIQUE (isbn)
- FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE CASCADE
- FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE

**Relationships:**
- Belongs to author
- Belongs to category
- Has many book_issues

---

### 5. book_issues
Stores book issue and return records.

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| user_id | BIGINT | Foreign key to users table |
| book_id | BIGINT | Foreign key to books table |
| issue_date | DATE | Date when book was issued |
| due_date | DATE | Date when book should be returned |
| return_date | DATE | Actual return date (nullable) |
| fine | DECIMAL(8,2) | Fine amount (default: 0) |
| status | ENUM('issued', 'returned') | Issue status (default: 'issued') |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |

**Indexes:**
- PRIMARY KEY (id)
- FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
- FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE

**Relationships:**
- Belongs to user
- Belongs to book

---

## Relationships Diagram

```
users (1) ----< (many) book_issues
books (1) ----< (many) book_issues
authors (1) ----< (many) books
categories (1) ----< (many) books
```

---

## Business Rules

1. **Book Availability:**
   - available_quantity is automatically updated when books are issued/returned
   - available_quantity = quantity - (number of currently issued books)

2. **Fine Calculation:**
   - ₹5 per day for late returns
   - Fine is calculated based on the difference between return_date and due_date
   - If return_date > due_date, fine = (days_late × 5)

3. **User Roles:**
   - Admin: Full access to all features
   - User: Can only view books and their own issued books

4. **Cascade Deletes:**
   - Deleting an author deletes all their books
   - Deleting a category deletes all books in that category
   - Deleting a user deletes all their book issue records
   - Deleting a book deletes all its issue records

---

## Sample Queries

### Get all available books with author and category
```sql
SELECT b.*, a.name as author_name, c.name as category_name
FROM books b
JOIN authors a ON b.author_id = a.id
JOIN categories c ON b.category_id = c.id
WHERE b.available_quantity > 0;
```

### Get all issued books for a user
```sql
SELECT bi.*, b.title, b.isbn
FROM book_issues bi
JOIN books b ON bi.book_id = b.id
WHERE bi.user_id = ? AND bi.status = 'issued';
```

### Calculate total fines for a user
```sql
SELECT SUM(fine) as total_fine
FROM book_issues
WHERE user_id = ?;
```

### Get overdue books
```sql
SELECT bi.*, u.name as user_name, b.title
FROM book_issues bi
JOIN users u ON bi.user_id = u.id
JOIN books b ON bi.book_id = b.id
WHERE bi.status = 'issued' AND bi.due_date < CURDATE();
```
