<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220913104106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add relation between game and category';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_232B318C12469DE2 ON game (category_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C12469DE2');
        $this->addSql('DROP INDEX IDX_232B318C12469DE2 ON game');
        $this->addSql('ALTER TABLE game DROP category_id');
    }
}
