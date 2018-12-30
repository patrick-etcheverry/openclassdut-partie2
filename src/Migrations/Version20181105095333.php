<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181105095333 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, type_ressource_id INT NOT NULL, titre VARCHAR(255) NOT NULL, descriptif LONGTEXT NOT NULL, date_ajout DATETIME NOT NULL, url_ressource VARCHAR(255) NOT NULL, url_vignette VARCHAR(255) NOT NULL, INDEX IDX_939F45447B2F6F2F (type_ressource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource_module (ressource_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_E665F595FC6CD52A (ressource_id), INDEX IDX_E665F595AFC2B591 (module_id), PRIMARY KEY(ressource_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F45447B2F6F2F FOREIGN KEY (type_ressource_id) REFERENCES type_ressource (id)');
        $this->addSql('ALTER TABLE ressource_module ADD CONSTRAINT FK_E665F595FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource_module ADD CONSTRAINT FK_E665F595AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ressource_module DROP FOREIGN KEY FK_E665F595FC6CD52A');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE ressource_module');
    }
}
