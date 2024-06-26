<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412101046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '2 - création du reste de la base de données';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, step_id INT NOT NULL, path VARCHAR(255) NOT NULL, size DOUBLE PRECISION NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_C53D045F989D9B62 (slug), INDEX IDX_C53D045F59D8A214 (recipe_id), INDEX IDX_C53D045F73B21E9C (step_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, vegetarian TINYINT(1) NOT NULL, vegan TINYINT(1) NOT NULL, dairy_free TINYINT(1) NOT NULL, gluten_free TINYINT(1) NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_6BAF7870989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_group (id INT AUTO_INCREMENT NOT NULL, priority INT NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_74F22304989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_has_ingredient (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, unit_id INT DEFAULT NULL, ingredient_id INT NOT NULL, ingredient_group_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, optional TINYINT(1) NOT NULL, INDEX IDX_FF7A137059D8A214 (recipe_id), INDEX IDX_FF7A1370F8BD700D (unit_id), INDEX IDX_FF7A1370933FE08C (ingredient_id), INDEX IDX_FF7A13708C5289C9 (ingredient_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_5F8A7F73989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_recipe (source_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_6C7794D1953C1C61 (source_id), INDEX IDX_6C7794D159D8A214 (recipe_id), PRIMARY KEY(source_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, priority INT DEFAULT NULL, menu TINYINT(1) NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_389B783989D9B62 (slug), INDEX IDX_389B783727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_33C9F81BBAD26311 (tag_id), INDEX IDX_33C9F81B59D8A214 (recipe_id), PRIMARY KEY(tag_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, singular VARCHAR(255) NOT NULL, plural VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F73B21E9C FOREIGN KEY (step_id) REFERENCES step (id)');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A137059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A1370F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A1370933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A13708C5289C9 FOREIGN KEY (ingredient_group_id) REFERENCES ingredient_group (id)');
        $this->addSql('ALTER TABLE source_recipe ADD CONSTRAINT FK_6C7794D1953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE source_recipe ADD CONSTRAINT FK_6C7794D159D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783727ACA70 FOREIGN KEY (parent_id) REFERENCES tag (id)');
        $this->addSql('ALTER TABLE tag_recipe ADD CONSTRAINT FK_33C9F81BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_recipe ADD CONSTRAINT FK_33C9F81B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F59D8A214');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F73B21E9C');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP FOREIGN KEY FK_FF7A137059D8A214');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP FOREIGN KEY FK_FF7A1370F8BD700D');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP FOREIGN KEY FK_FF7A1370933FE08C');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP FOREIGN KEY FK_FF7A13708C5289C9');
        $this->addSql('ALTER TABLE source_recipe DROP FOREIGN KEY FK_6C7794D1953C1C61');
        $this->addSql('ALTER TABLE source_recipe DROP FOREIGN KEY FK_6C7794D159D8A214');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783727ACA70');
        $this->addSql('ALTER TABLE tag_recipe DROP FOREIGN KEY FK_33C9F81BBAD26311');
        $this->addSql('ALTER TABLE tag_recipe DROP FOREIGN KEY FK_33C9F81B59D8A214');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_group');
        $this->addSql('DROP TABLE recipe_has_ingredient');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE source_recipe');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('DROP TABLE unit');
    }
}
