<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180511145620 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, color VARCHAR(10) NOT NULL, icon_src VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_participant (id INT AUTO_INCREMENT NOT NULL, team_id_id INT NOT NULL, user_id_id INT NOT NULL, matched_user_id_id INT NOT NULL, INDEX IDX_3CAF845CB842D717 (team_id_id), INDEX IDX_3CAF845C9D86650F (user_id_id), INDEX IDX_3CAF845CCD6A0F01 (matched_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, category_id_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, email VARCHAR(150) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D6499777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_participant ADD CONSTRAINT FK_3CAF845CB842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_participant ADD CONSTRAINT FK_3CAF845C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_participant ADD CONSTRAINT FK_3CAF845CCD6A0F01 FOREIGN KEY (matched_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE participant');
        $this->addSql('ALTER TABLE team ADD price_min INT NOT NULL, ADD price_max INT NOT NULL, CHANGE fixe_price admin_id_id INT NOT NULL, CHANGE admin_email name VARCHAR(150) NOT NULL, CHANGE admin_password team_code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FDF6E65AD FOREIGN KEY (admin_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FDF6E65AD ON team (admin_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499777D11E');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FDF6E65AD');
        $this->addSql('ALTER TABLE team_participant DROP FOREIGN KEY FK_3CAF845C9D86650F');
        $this->addSql('ALTER TABLE team_participant DROP FOREIGN KEY FK_3CAF845CCD6A0F01');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, team_id_id INT NOT NULL, email VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, pseudo VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, avatar INT DEFAULT NULL, INDEX IDX_D79F6B11B842D717 (team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE team_participant');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_C4E0A61FDF6E65AD ON team');
        $this->addSql('ALTER TABLE team ADD fixe_price INT NOT NULL, DROP admin_id_id, DROP price_min, DROP price_max, CHANGE name admin_email VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE team_code admin_password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
