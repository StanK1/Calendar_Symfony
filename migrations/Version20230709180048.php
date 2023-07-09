<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230709180048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $appointmentsTable = $schema->createTable('appointments');
        $appointmentsTable->addColumn('id', Types::INTEGER)
            ->setAutoincrement(true)
            ->setNotnull(true);
        $appointmentsTable->addColumn('date', Types::DATE)
            ->setNotnull(true);
        $appointmentsTable->addColumn('time', Types::TIME)
            ->setNotnull(true);
        $appointmentsTable->addColumn('name', Types::STRING)
            ->setNotnull(true);
        $appointmentsTable->addColumn('email', Types::STRING)
            ->setNotnull(true);
        $appointmentsTable->addColumn('phone', Types::STRING)
            ->setNotnull(true);
        $appointmentsTable->setPrimaryKey(['id']);
    }
    

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, date_time DATETIME NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE appointments');
    }
}
