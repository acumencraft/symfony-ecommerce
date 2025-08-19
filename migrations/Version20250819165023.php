<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250819165023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, type VARCHAR(20) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, company VARCHAR(255) DEFAULT NULL, address_line1 VARCHAR(255) NOT NULL, address_line2 VARCHAR(255) DEFAULT NULL, city VARCHAR(100) NOT NULL, state VARCHAR(100) DEFAULT NULL, postal_code VARCHAR(20) NOT NULL, country_code VARCHAR(2) NOT NULL, phone VARCHAR(20) DEFAULT NULL, is_default TINYINT(1) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D4E6F819395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(500) DEFAULT NULL, is_active TINYINT(1) NOT NULL, sort_order INT NOT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(500) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_translations (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, locale VARCHAR(5) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(500) DEFAULT NULL, INDEX IDX_1C60F91512469DE2 (category_id), UNIQUE INDEX unique_category_locale (category_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupon_usage (id INT AUTO_INCREMENT NOT NULL, coupon_id INT NOT NULL, related_order_id INT NOT NULL, customer_id INT NOT NULL, discount_amount NUMERIC(10, 2) NOT NULL, used_at DATETIME NOT NULL, INDEX IDX_3EA5018066C5951B (coupon_id), INDEX IDX_3EA501802B1C2395 (related_order_id), INDEX IDX_3EA501809395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupons (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(100) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type VARCHAR(50) NOT NULL, value NUMERIC(10, 2) NOT NULL, minimum_amount NUMERIC(10, 2) DEFAULT NULL, maximum_discount NUMERIC(10, 2) DEFAULT NULL, usage_limit INT DEFAULT NULL, usage_count INT NOT NULL, is_active TINYINT(1) NOT NULL, starts_at DATETIME DEFAULT NULL, expires_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_COUPON_CODE (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, phone VARCHAR(20) DEFAULT NULL, birth_date DATE DEFAULT NULL, gender VARCHAR(10) DEFAULT NULL, newsletter_subscription TINYINT(1) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_81398E09A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_items (id INT AUTO_INCREMENT NOT NULL, related_order_id INT NOT NULL, product_id INT NOT NULL, variant_id INT DEFAULT NULL, product_name VARCHAR(255) NOT NULL, product_sku VARCHAR(100) NOT NULL, quantity INT NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, total_price NUMERIC(10, 2) NOT NULL, variant_name VARCHAR(255) DEFAULT NULL, product_data JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_62809DB02B1C2395 (related_order_id), INDEX IDX_62809DB04584665A (product_id), INDEX IDX_62809DB03B69A9AF (variant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, order_number VARCHAR(50) NOT NULL, status VARCHAR(30) NOT NULL, payment_status VARCHAR(30) NOT NULL, currency VARCHAR(3) NOT NULL, subtotal NUMERIC(10, 2) NOT NULL, tax_amount NUMERIC(10, 2) NOT NULL, shipping_amount NUMERIC(10, 2) NOT NULL, discount_amount NUMERIC(10, 2) NOT NULL, total NUMERIC(10, 2) NOT NULL, notes LONGTEXT DEFAULT NULL, billing_firstname VARCHAR(100) NOT NULL, billing_lastname VARCHAR(100) NOT NULL, billing_company VARCHAR(255) DEFAULT NULL, billing_address_line1 VARCHAR(255) NOT NULL, billing_address_line2 VARCHAR(255) DEFAULT NULL, billing_city VARCHAR(100) NOT NULL, billing_state VARCHAR(100) DEFAULT NULL, billing_postal_code VARCHAR(20) NOT NULL, billing_country_code VARCHAR(2) NOT NULL, billing_phone VARCHAR(20) DEFAULT NULL, shipping_last_name VARCHAR(100) NOT NULL, shipping_first_name VARCHAR(100) NOT NULL, shipping_company VARCHAR(255) DEFAULT NULL, shipping_address_line1 VARCHAR(255) NOT NULL, shipping_address_line2 VARCHAR(255) DEFAULT NULL, shipping_city VARCHAR(100) NOT NULL, shipping_state VARCHAR(100) DEFAULT NULL, shipping_postal_code VARCHAR(20) NOT NULL, shipping_country_code VARCHAR(2) NOT NULL, shipping_phone VARCHAR(20) DEFAULT NULL, shipped_at DATETIME DEFAULT NULL, delivered_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E52FFDEE9395C3F3 (customer_id), UNIQUE INDEX UNIQ_ORDER_NUMBER (order_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_refunds (id INT AUTO_INCREMENT NOT NULL, payment_id INT NOT NULL, amount NUMERIC(10, 2) NOT NULL, reason VARCHAR(255) DEFAULT NULL, refund_id VARCHAR(255) DEFAULT NULL, status VARCHAR(30) NOT NULL, processed_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_67AC34334C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payments (id INT AUTO_INCREMENT NOT NULL, related_order_id INT NOT NULL, payment_method VARCHAR(50) NOT NULL, payment_status VARCHAR(30) NOT NULL, amount NUMERIC(10, 2) NOT NULL, currency VARCHAR(3) NOT NULL, transaction_id VARCHAR(255) DEFAULT NULL, gateway_response JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', notes LONGTEXT DEFAULT NULL, processed_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_65D29B322B1C2395 (related_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attribute_values (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, attribute_id INT NOT NULL, value LONGTEXT NOT NULL, INDEX IDX_96CA06404584665A (product_id), INDEX IDX_96CA0640B6E62EFA (attribute_id), UNIQUE INDEX unique_product_attribute (product_id, attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attributes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, type VARCHAR(20) NOT NULL, is_required TINYINT(1) NOT NULL, is_filterable TINYINT(1) NOT NULL, sort_order INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_PRODUCT_ATTRIBUTE_SLUG (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_image (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, variant_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, original_filename VARCHAR(255) NOT NULL, alt_text VARCHAR(255) DEFAULT NULL, sort_order INT NOT NULL, is_featured TINYINT(1) NOT NULL, file_size INT DEFAULT NULL, mime_type VARCHAR(100) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_64617F034584665A (product_id), INDEX IDX_64617F033B69A9AF (variant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_translations (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, locale VARCHAR(5) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(500) DEFAULT NULL, INDEX IDX_4B13F8EC4584665A (product_id), UNIQUE INDEX unique_product_locale (product_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_variants (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, sku VARCHAR(100) NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, sale_price NUMERIC(10, 2) DEFAULT NULL, stock_quantity INT NOT NULL, weight NUMERIC(8, 2) DEFAULT NULL, image VARCHAR(500) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, sort_order INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_782839764584665A (product_id), UNIQUE INDEX UNIQ_PRODUCT_VARIANT_SKU (sku), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, sku VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, price NUMERIC(10, 2) DEFAULT NULL, stock_quantity INT DEFAULT NULL, status VARCHAR(30) NOT NULL, is_featured TINYINT(1) NOT NULL, sale_price NUMERIC(10, 2) DEFAULT NULL, cost_price NUMERIC(10, 2) DEFAULT NULL, weight NUMERIC(8, 2) DEFAULT NULL, length NUMERIC(8, 2) DEFAULT NULL, width NUMERIC(8, 2) DEFAULT NULL, height NUMERIC(8, 2) DEFAULT NULL, manage_stock TINYINT(1) NOT NULL, stock_status VARCHAR(30) DEFAULT \'in_stock\' NOT NULL, visibility VARCHAR(30) DEFAULT \'visible\' NOT NULL, is_virtual TINYINT(1) NOT NULL, is_downloadable TINYINT(1) NOT NULL, tax_class VARCHAR(50) DEFAULT \'standard\' NOT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(500) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_PRODUCT_SLUG (slug), UNIQUE INDEX UNIQ_PRODUCT_SKU (sku), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipments (id INT AUTO_INCREMENT NOT NULL, related_order_id INT NOT NULL, shipping_method_id INT NOT NULL, tracking_number VARCHAR(255) DEFAULT NULL, carrier VARCHAR(100) DEFAULT NULL, status VARCHAR(30) NOT NULL, shipped_at DATETIME DEFAULT NULL, delivered_at DATETIME DEFAULT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_94699AD42B1C2395 (related_order_id), INDEX IDX_94699AD45F7D6850 (shipping_method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipping_methods (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, cost NUMERIC(10, 2) NOT NULL, free_shipping_minimum NUMERIC(10, 2) DEFAULT NULL, is_active TINYINT(1) NOT NULL, sort_order INT NOT NULL, countries JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, verification_token VARCHAR(255) DEFAULT NULL, reset_password_token VARCHAR(255) DEFAULT NULL, reset_password_expires_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F819395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category_translations ADD CONSTRAINT FK_1C60F91512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE coupon_usage ADD CONSTRAINT FK_3EA5018066C5951B FOREIGN KEY (coupon_id) REFERENCES coupons (id)');
        $this->addSql('ALTER TABLE coupon_usage ADD CONSTRAINT FK_3EA501802B1C2395 FOREIGN KEY (related_order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE coupon_usage ADD CONSTRAINT FK_3EA501809395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB02B1C2395 FOREIGN KEY (related_order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB04584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB03B69A9AF FOREIGN KEY (variant_id) REFERENCES product_variants (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE payment_refunds ADD CONSTRAINT FK_67AC34334C3A3BB FOREIGN KEY (payment_id) REFERENCES payments (id)');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B322B1C2395 FOREIGN KEY (related_order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE product_attribute_values ADD CONSTRAINT FK_96CA06404584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_attribute_values ADD CONSTRAINT FK_96CA0640B6E62EFA FOREIGN KEY (attribute_id) REFERENCES product_attributes (id)');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F033B69A9AF FOREIGN KEY (variant_id) REFERENCES product_variants (id)');
        $this->addSql('ALTER TABLE product_translations ADD CONSTRAINT FK_4B13F8EC4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_variants ADD CONSTRAINT FK_782839764584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shipments ADD CONSTRAINT FK_94699AD42B1C2395 FOREIGN KEY (related_order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE shipments ADD CONSTRAINT FK_94699AD45F7D6850 FOREIGN KEY (shipping_method_id) REFERENCES shipping_methods (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F819395C3F3');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE category_translations DROP FOREIGN KEY FK_1C60F91512469DE2');
        $this->addSql('ALTER TABLE coupon_usage DROP FOREIGN KEY FK_3EA5018066C5951B');
        $this->addSql('ALTER TABLE coupon_usage DROP FOREIGN KEY FK_3EA501802B1C2395');
        $this->addSql('ALTER TABLE coupon_usage DROP FOREIGN KEY FK_3EA501809395C3F3');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09A76ED395');
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB02B1C2395');
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB04584665A');
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB03B69A9AF');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9395C3F3');
        $this->addSql('ALTER TABLE payment_refunds DROP FOREIGN KEY FK_67AC34334C3A3BB');
        $this->addSql('ALTER TABLE payments DROP FOREIGN KEY FK_65D29B322B1C2395');
        $this->addSql('ALTER TABLE product_attribute_values DROP FOREIGN KEY FK_96CA06404584665A');
        $this->addSql('ALTER TABLE product_attribute_values DROP FOREIGN KEY FK_96CA0640B6E62EFA');
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F034584665A');
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F033B69A9AF');
        $this->addSql('ALTER TABLE product_translations DROP FOREIGN KEY FK_4B13F8EC4584665A');
        $this->addSql('ALTER TABLE product_variants DROP FOREIGN KEY FK_782839764584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE shipments DROP FOREIGN KEY FK_94699AD42B1C2395');
        $this->addSql('ALTER TABLE shipments DROP FOREIGN KEY FK_94699AD45F7D6850');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_translations');
        $this->addSql('DROP TABLE coupon_usage');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE order_items');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE payment_refunds');
        $this->addSql('DROP TABLE payments');
        $this->addSql('DROP TABLE product_attribute_values');
        $this->addSql('DROP TABLE product_attributes');
        $this->addSql('DROP TABLE product_image');
        $this->addSql('DROP TABLE product_translations');
        $this->addSql('DROP TABLE product_variants');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE shipments');
        $this->addSql('DROP TABLE shipping_methods');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
