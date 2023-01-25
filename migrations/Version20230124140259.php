<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124140259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mcommande (id INT AUTO_INCREMENT NOT NULL, info VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mcommande_product (mcommande_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_61FE38F924453431 (mcommande_id), INDEX IDX_61FE38F94584665A (product_id), PRIMARY KEY(mcommande_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mcommande_product ADD CONSTRAINT FK_61FE38F924453431 FOREIGN KEY (mcommande_id) REFERENCES mcommande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mcommande_product ADD CONSTRAINT FK_61FE38F94584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mcommande_product DROP FOREIGN KEY FK_61FE38F924453431');
        $this->addSql('ALTER TABLE mcommande_product DROP FOREIGN KEY FK_61FE38F94584665A');
        $this->addSql('DROP TABLE mcommande');
        $this->addSql('DROP TABLE mcommande_product');
    }
}
