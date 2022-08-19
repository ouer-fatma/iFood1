<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420062546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A76ED395');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B33E1689A');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BA76ED395');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BDF66E98B');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B33E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id)');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10427FB44');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC1082EA2E54');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10427FB44 FOREIGN KEY (delivery_guy_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC1082EA2E54 FOREIGN KEY (commande_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A76ED395');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E2371F7E88B');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E2371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE pack_line DROP FOREIGN KEY FK_9895ED4F1919B217');
        $this->addSql('ALTER TABLE pack_line DROP FOREIGN KEY FK_9895ED4FDF66E98B');
        $this->addSql('ALTER TABLE pack_line ADD CONSTRAINT FK_9895ED4F1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE pack_line ADD CONSTRAINT FK_9895ED4FDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id)');
        $this->addSql('ALTER TABLE plate DROP FOREIGN KEY FK_719ED75B12469DE2');
        $this->addSql('ALTER TABLE plate ADD quantity INT NOT NULL');
        $this->addSql('ALTER TABLE plate ADD CONSTRAINT FK_719ED75B12469DE2 FOREIGN KEY (category_id) REFERENCES plate_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A76ED395');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BA76ED395');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B33E1689A');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BDF66E98B');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B33E1689A FOREIGN KEY (command_id) REFERENCES command (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10427FB44');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC1082EA2E54');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10427FB44 FOREIGN KEY (delivery_guy_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC1082EA2E54 FOREIGN KEY (commande_id) REFERENCES command (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A76ED395');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E2371F7E88B');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E2371F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack_line DROP FOREIGN KEY FK_9895ED4FDF66E98B');
        $this->addSql('ALTER TABLE pack_line DROP FOREIGN KEY FK_9895ED4F1919B217');
        $this->addSql('ALTER TABLE pack_line ADD CONSTRAINT FK_9895ED4FDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack_line ADD CONSTRAINT FK_9895ED4F1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plate DROP FOREIGN KEY FK_719ED75B12469DE2');
        $this->addSql('ALTER TABLE plate DROP quantity');
        $this->addSql('ALTER TABLE plate ADD CONSTRAINT FK_719ED75B12469DE2 FOREIGN KEY (category_id) REFERENCES plate_category (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
