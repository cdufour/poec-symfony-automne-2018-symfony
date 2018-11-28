<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128100842 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proverb DROP FOREIGN KEY FK_9271AE88F92F3E70');
        $this->addSql('DROP INDEX UNIQ_9271AE88F92F3E70 ON proverb');
        $this->addSql('ALTER TABLE proverb DROP country_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proverb ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE proverb ADD CONSTRAINT FK_9271AE88F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9271AE88F92F3E70 ON proverb (country_id)');
    }
}
