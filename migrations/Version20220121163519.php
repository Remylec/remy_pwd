<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121163519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, advert_id INT NOT NULL, INDEX IDX_E46960F5A76ED395 (user_id), INDEX IDX_E46960F5D07ECCB6 (advert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5D07ECCB6 FOREIGN KEY (advert_id) REFERENCES adverts (id)');
        $this->addSql('ALTER TABLE adverts ADD user_id INT NOT NULL, ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE adverts ADD CONSTRAINT FK_8C88E777A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE adverts ADD CONSTRAINT FK_8C88E7774584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_8C88E777A76ED395 ON adverts (user_id)');
        $this->addSql('CREATE INDEX IDX_8C88E7774584665A ON adverts (product_id)');
        $this->addSql('ALTER TABLE product ADD brand_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD44F5D008 ON product (brand_id)');
        $this->addSql('ALTER TABLE user ADD pseudo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE favorites');
        $this->addSql('ALTER TABLE adverts DROP FOREIGN KEY FK_8C88E777A76ED395');
        $this->addSql('ALTER TABLE adverts DROP FOREIGN KEY FK_8C88E7774584665A');
        $this->addSql('DROP INDEX IDX_8C88E777A76ED395 ON adverts');
        $this->addSql('DROP INDEX IDX_8C88E7774584665A ON adverts');
        $this->addSql('ALTER TABLE adverts DROP user_id, DROP product_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008');
        $this->addSql('DROP INDEX IDX_D34A04AD44F5D008 ON product');
        $this->addSql('ALTER TABLE product DROP brand_id');
        $this->addSql('ALTER TABLE user DROP pseudo');
    }
}
