<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230524130854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, seats INT NOT NULL, created DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, confirmed TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, departure VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, seats INT NOT NULL, price DOUBLE PRECISION NOT NULL, date DATE NOT NULL, created DATE NOT NULL, INDEX IDX_9B3D7CD0B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride_rule (ride_id INT NOT NULL, rule_id INT NOT NULL, INDEX IDX_DE799B8302A8A70 (ride_id), INDEX IDX_DE799B8744E0351 (rule_id), PRIMARY KEY(ride_id, rule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, ride_id INT DEFAULT NULL, rule_id INT DEFAULT NULL, rides_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, car_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone INT NOT NULL, created DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649302A8A70 (ride_id), INDEX IDX_8D93D649744E0351 (rule_id), INDEX IDX_8D93D649B744E693 (rides_id), INDEX IDX_8D93D649B83297E7 (reservation_id), INDEX IDX_8D93D649C3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE ride_rule ADD CONSTRAINT FK_DE799B8302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_rule ADD CONSTRAINT FK_DE799B8744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B744E693 FOREIGN KEY (rides_id) REFERENCES ride (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD0B83297E7');
        $this->addSql('ALTER TABLE ride_rule DROP FOREIGN KEY FK_DE799B8302A8A70');
        $this->addSql('ALTER TABLE ride_rule DROP FOREIGN KEY FK_DE799B8744E0351');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649302A8A70');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649744E0351');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B744E693');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B83297E7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C3C6F69F');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE ride');
        $this->addSql('DROP TABLE ride_rule');
        $this->addSql('DROP TABLE rule');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
