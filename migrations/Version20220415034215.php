<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415034215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date_command DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_8ECAEAD4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_line (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, command_id INT NOT NULL, plate_id INT NOT NULL, quntity INT NOT NULL, INDEX IDX_70BE1A7BA76ED395 (user_id), INDEX IDX_70BE1A7B33E1689A (command_id), INDEX IDX_70BE1A7BDF66E98B (plate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, delivery_guy_id INT NOT NULL, commande_id INT NOT NULL, lang VARCHAR(255) NOT NULL, attitude VARCHAR(255) NOT NULL, price BIGINT NOT NULL, INDEX IDX_3781EC10427FB44 (delivery_guy_id), UNIQUE INDEX UNIQ_3781EC1082EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(200) NOT NULL, description VARCHAR(200) NOT NULL, date DATETIME NOT NULL, INDEX IDX_3BAE0AA7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, name VARCHAR(200) NOT NULL, description VARCHAR(200) NOT NULL, INDEX IDX_97DE5E2371F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack_line (id INT AUTO_INCREMENT NOT NULL, plate_id INT NOT NULL, pack_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_9895ED4FDF66E98B (plate_id), INDEX IDX_9895ED4F1919B217 (pack_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plate (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, description VARCHAR(200) NOT NULL, name VARCHAR(200) NOT NULL, price BIGINT NOT NULL, INDEX IDX_719ED75B12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plate_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, description VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
             $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B33E1689A FOREIGN KEY (command_id) REFERENCES command (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10427FB44 FOREIGN KEY (delivery_guy_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC1082EA2E54 FOREIGN KEY (commande_id) REFERENCES command (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E2371F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack_line ADD CONSTRAINT FK_9895ED4FDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack_line ADD CONSTRAINT FK_9895ED4F1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plate ADD CONSTRAINT FK_719ED75B12469DE2 FOREIGN KEY (category_id) REFERENCES plate_category (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
