<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128100416 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE proverb (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, body LONGTEXT NOT NULL, popularity INT NOT NULL, UNIQUE INDEX UNIQ_9271AE88F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proverb_topic (proverb_id INT NOT NULL, topic_id INT NOT NULL, INDEX IDX_7982EA29EE15F57 (proverb_id), INDEX IDX_7982EA21F55203D (topic_id), PRIMARY KEY(proverb_id, topic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proverb ADD CONSTRAINT FK_9271AE88F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE proverb_topic ADD CONSTRAINT FK_7982EA29EE15F57 FOREIGN KEY (proverb_id) REFERENCES proverb (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proverb_topic ADD CONSTRAINT FK_7982EA21F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proverb_topic DROP FOREIGN KEY FK_7982EA29EE15F57');
        $this->addSql('DROP TABLE proverb');
        $this->addSql('DROP TABLE proverb_topic');
    }
}
