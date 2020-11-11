<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105151557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tips_language (tips_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_3F8C4A1AB3E8864B (tips_id), INDEX IDX_3F8C4A1A82F1BAF4 (language_id), PRIMARY KEY(tips_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tips_language ADD CONSTRAINT FK_3F8C4A1AB3E8864B FOREIGN KEY (tips_id) REFERENCES tips (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tips_language ADD CONSTRAINT FK_3F8C4A1A82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tips_language');
    }
}
