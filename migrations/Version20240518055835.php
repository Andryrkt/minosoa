<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518055835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_items ADD order_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_items ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB0FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB04584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_62809DB0FCDAEAAA ON order_items (order_id_id)');
        $this->addSql('CREATE INDEX IDX_62809DB04584665A ON order_items (product_id)');
        $this->addSql('ALTER TABLE orders ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE6BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E52FFDEE6BF700BD ON orders (status_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE9395C3F3 ON orders (customer_id)');
        $this->addSql('ALTER TABLE stock_mouvements ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock_mouvements ADD CONSTRAINT FK_747D74F04584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_747D74F04584665A ON stock_mouvements (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEE6BF700BD');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEE9395C3F3');
        $this->addSql('DROP INDEX IDX_E52FFDEE6BF700BD');
        $this->addSql('DROP INDEX IDX_E52FFDEE9395C3F3');
        $this->addSql('ALTER TABLE orders DROP status_id');
        $this->addSql('ALTER TABLE orders DROP customer_id');
        $this->addSql('ALTER TABLE stock_mouvements DROP CONSTRAINT FK_747D74F04584665A');
        $this->addSql('DROP INDEX IDX_747D74F04584665A');
        $this->addSql('ALTER TABLE stock_mouvements DROP product_id');
        $this->addSql('ALTER TABLE order_items DROP CONSTRAINT FK_62809DB0FCDAEAAA');
        $this->addSql('ALTER TABLE order_items DROP CONSTRAINT FK_62809DB04584665A');
        $this->addSql('DROP INDEX IDX_62809DB0FCDAEAAA');
        $this->addSql('DROP INDEX IDX_62809DB04584665A');
        $this->addSql('ALTER TABLE order_items DROP order_id_id');
        $this->addSql('ALTER TABLE order_items DROP product_id');
    }
}
