<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907092538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE turbo_question (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, correct_answer VARCHAR(255) NOT NULL, first_wrong_answer VARCHAR(255) NOT NULL, second_wrong_answer VARCHAR(255) NOT NULL, third_wrong_answer VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, difficulty INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turbo_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, highest_streak INT DEFAULT NULL, highest_overall_streak INT DEFAULT NULL, played_games INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE turbo_question');
        $this->addSql('DROP TABLE turbo_user');
    }
}
