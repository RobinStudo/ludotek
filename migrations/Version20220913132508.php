<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220913132508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add relation between game and designer';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE game_designer (game_id INT NOT NULL, designer_id INT NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_18E4217DE48FD905 (game_id), INDEX IDX_18E4217DCFC54FAB (designer_id), PRIMARY KEY(game_id, designer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_designer ADD CONSTRAINT FK_18E4217DE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_designer ADD CONSTRAINT FK_18E4217DCFC54FAB FOREIGN KEY (designer_id) REFERENCES designer (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game_designer DROP FOREIGN KEY FK_18E4217DE48FD905');
        $this->addSql('ALTER TABLE game_designer DROP FOREIGN KEY FK_18E4217DCFC54FAB');
        $this->addSql('DROP TABLE game_designer');
    }
}
