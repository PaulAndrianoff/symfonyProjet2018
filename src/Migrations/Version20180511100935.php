<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180511100935 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE team_participants DROP FOREIGN KEY FK_79EF7D509D86650F');
        $this->addSql('ALTER TABLE team_user DROP FOREIGN KEY FK_5C722232A76ED395');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, team_id_id INT NOT NULL, email VARCHAR(150) NOT NULL, pseudo VARCHAR(150) NOT NULL, avatar INT DEFAULT NULL, INDEX IDX_D79F6B11B842D717 (team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('DROP TABLE team_participants');
        $this->addSql('DROP TABLE team_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wishe');
        $this->addSql('ALTER TABLE team ADD admin_email VARCHAR(150) NOT NULL, ADD admin_password VARCHAR(255) NOT NULL, CHANGE draw_at draw_at DATETIME NOT NULL, CHANGE end_at end_at DATETIME NOT NULL, CHANGE price fixe_price INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team_participants (id INT AUTO_INCREMENT NOT NULL, team_id_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, INDEX IDX_79EF7D50B842D717 (team_id_id), INDEX IDX_79EF7D509D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_user (team_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5C722232296CD8AE (team_id), INDEX IDX_5C722232A76ED395 (user_id), PRIMARY KEY(team_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, pseudo VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, avatar_img_url VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wishe (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, url_image VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, link VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, team_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_participants ADD CONSTRAINT FK_79EF7D509D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_participants ADD CONSTRAINT FK_79EF7D50B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_user ADD CONSTRAINT FK_5C722232296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_user ADD CONSTRAINT FK_5C722232A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE participant');
        $this->addSql('ALTER TABLE team DROP admin_email, DROP admin_password, CHANGE end_at end_at DATETIME DEFAULT NULL, CHANGE draw_at draw_at DATETIME DEFAULT NULL, CHANGE fixe_price price INT NOT NULL');
    }
}
