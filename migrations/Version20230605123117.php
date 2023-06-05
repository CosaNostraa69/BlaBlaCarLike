<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605123117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_773DE69D7E3C61F9 ON car (owner_id)');
        $this->addSql('ALTER TABLE reservation ADD ride_id INT NOT NULL, ADD passenger_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849554502E565 FOREIGN KEY (passenger_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C84955302A8A70 ON reservation (ride_id)');
        $this->addSql('CREATE INDEX IDX_42C849554502E565 ON reservation (passenger_id)');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD0B83297E7');
        $this->addSql('DROP INDEX IDX_9B3D7CD0B83297E7 ON ride');
        $this->addSql('ALTER TABLE ride ADD driver_id INT NOT NULL, DROP reservation_id, CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD0C3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9B3D7CD0C3423909 ON ride (driver_id)');
        $this->addSql('ALTER TABLE rule ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE rule ADD CONSTRAINT FK_46D8ACCCF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_46D8ACCCF675F31B ON rule (author_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649302A8A70');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649744E0351');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B744E693');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B83297E7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C3C6F69F');
        $this->addSql('DROP INDEX IDX_8D93D649C3C6F69F ON user');
        $this->addSql('DROP INDEX IDX_8D93D649B83297E7 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649B744E693 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649744E0351 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649302A8A70 ON user');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) DEFAULT NULL, DROP ride_id, DROP rule_id, DROP rides_id, DROP reservation_id, DROP car_id, DROP roles');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD0C3423909');
        $this->addSql('DROP INDEX IDX_9B3D7CD0C3423909 ON ride');
        $this->addSql('ALTER TABLE ride ADD reservation_id INT DEFAULT NULL, DROP driver_id, CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9B3D7CD0B83297E7 ON ride (reservation_id)');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D7E3C61F9');
        $this->addSql('DROP INDEX IDX_773DE69D7E3C61F9 ON car');
        $this->addSql('ALTER TABLE car DROP owner_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955302A8A70');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849554502E565');
        $this->addSql('DROP INDEX IDX_42C84955302A8A70 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849554502E565 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP ride_id, DROP passenger_id');
        $this->addSql('ALTER TABLE user ADD ride_id INT DEFAULT NULL, ADD rule_id INT DEFAULT NULL, ADD rides_id INT DEFAULT NULL, ADD reservation_id INT DEFAULT NULL, ADD car_id INT DEFAULT NULL, ADD roles JSON NOT NULL, DROP role');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B744E693 FOREIGN KEY (rides_id) REFERENCES ride (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D649C3C6F69F ON user (car_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B83297E7 ON user (reservation_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B744E693 ON user (rides_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649744E0351 ON user (rule_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649302A8A70 ON user (ride_id)');
        $this->addSql('ALTER TABLE rule DROP FOREIGN KEY FK_46D8ACCCF675F31B');
        $this->addSql('DROP INDEX IDX_46D8ACCCF675F31B ON rule');
        $this->addSql('ALTER TABLE rule DROP author_id');
    }
}
