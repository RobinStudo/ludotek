<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220913122938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add relation between game and editor';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE game_editor (game_id INT NOT NULL, editor_id INT NOT NULL, INDEX IDX_B1C45C72E48FD905 (game_id), INDEX IDX_B1C45C726995AC4C (editor_id), PRIMARY KEY(game_id, editor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_editor ADD CONSTRAINT FK_B1C45C72E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_editor ADD CONSTRAINT FK_B1C45C726995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game_editor DROP FOREIGN KEY FK_B1C45C72E48FD905');
        $this->addSql('ALTER TABLE game_editor DROP FOREIGN KEY FK_B1C45C726995AC4C');
        $this->addSql('DROP TABLE game_editor');
    }
}
