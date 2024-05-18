<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518054414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_three_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category_three (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category_three.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN category_three.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE category_three_category_two (category_three_id INT NOT NULL, category_two_id INT NOT NULL, PRIMARY KEY(category_three_id, category_two_id))');
        $this->addSql('CREATE INDEX IDX_9D5AC888C0DB891E ON category_three_category_two (category_three_id)');
        $this->addSql('CREATE INDEX IDX_9D5AC8889F2EE3A7 ON category_three_category_two (category_two_id)');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, purchase_price DOUBLE PRECISION NOT NULL, selling_price DOUBLE PRECISION DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, princip_actif VARCHAR(255) DEFAULT NULL, expiry_date DATE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_category_one (product_id INT NOT NULL, category_one_id INT NOT NULL, PRIMARY KEY(product_id, category_one_id))');
        $this->addSql('CREATE INDEX IDX_D20A09C04584665A ON product_category_one (product_id)');
        $this->addSql('CREATE INDEX IDX_D20A09C0F4720468 ON product_category_one (category_one_id)');
        $this->addSql('CREATE TABLE product_units (product_id INT NOT NULL, units_id INT NOT NULL, PRIMARY KEY(product_id, units_id))');
        $this->addSql('CREATE INDEX IDX_48EC0F154584665A ON product_units (product_id)');
        $this->addSql('CREATE INDEX IDX_48EC0F1599387CE8 ON product_units (units_id)');
        $this->addSql('CREATE TABLE product_suppliers (product_id INT NOT NULL, suppliers_id INT NOT NULL, PRIMARY KEY(product_id, suppliers_id))');
        $this->addSql('CREATE INDEX IDX_C2880FD14584665A ON product_suppliers (product_id)');
        $this->addSql('CREATE INDEX IDX_C2880FD1355AF43 ON product_suppliers (suppliers_id)');
        $this->addSql('ALTER TABLE category_three_category_two ADD CONSTRAINT FK_9D5AC888C0DB891E FOREIGN KEY (category_three_id) REFERENCES category_three (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category_three_category_two ADD CONSTRAINT FK_9D5AC8889F2EE3A7 FOREIGN KEY (category_two_id) REFERENCES category_two (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category_one ADD CONSTRAINT FK_D20A09C04584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category_one ADD CONSTRAINT FK_D20A09C0F4720468 FOREIGN KEY (category_one_id) REFERENCES category_one (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_units ADD CONSTRAINT FK_48EC0F154584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_units ADD CONSTRAINT FK_48EC0F1599387CE8 FOREIGN KEY (units_id) REFERENCES units (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_suppliers ADD CONSTRAINT FK_C2880FD14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_suppliers ADD CONSTRAINT FK_C2880FD1355AF43 FOREIGN KEY (suppliers_id) REFERENCES suppliers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_three_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('ALTER TABLE category_three_category_two DROP CONSTRAINT FK_9D5AC888C0DB891E');
        $this->addSql('ALTER TABLE category_three_category_two DROP CONSTRAINT FK_9D5AC8889F2EE3A7');
        $this->addSql('ALTER TABLE product_category_one DROP CONSTRAINT FK_D20A09C04584665A');
        $this->addSql('ALTER TABLE product_category_one DROP CONSTRAINT FK_D20A09C0F4720468');
        $this->addSql('ALTER TABLE product_units DROP CONSTRAINT FK_48EC0F154584665A');
        $this->addSql('ALTER TABLE product_units DROP CONSTRAINT FK_48EC0F1599387CE8');
        $this->addSql('ALTER TABLE product_suppliers DROP CONSTRAINT FK_C2880FD14584665A');
        $this->addSql('ALTER TABLE product_suppliers DROP CONSTRAINT FK_C2880FD1355AF43');
        $this->addSql('DROP TABLE category_three');
        $this->addSql('DROP TABLE category_three_category_two');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category_one');
        $this->addSql('DROP TABLE product_units');
        $this->addSql('DROP TABLE product_suppliers');
    }
}
