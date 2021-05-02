<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210501234203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E6614D45BBE');
        $this->addSql('DROP INDEX IDX_23A0E66C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, type_id, autor_id, content, titre, is_aprouve, make_at FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, autor_id INTEGER DEFAULT NULL, content CLOB DEFAULT NULL COLLATE BINARY, titre VARCHAR(255) NOT NULL COLLATE BINARY, is_aprouve BOOLEAN DEFAULT NULL, make_at DATETIME NOT NULL, CONSTRAINT FK_23A0E66C54C8C93 FOREIGN KEY (type_id) REFERENCES type_revu (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_23A0E6614D45BBE FOREIGN KEY (autor_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, type_id, autor_id, content, titre, is_aprouve, make_at) SELECT id, type_id, autor_id, content, titre, is_aprouve, make_at FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E6614D45BBE ON article (autor_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66C54C8C93 ON article (type_id)');
        $this->addSql('DROP INDEX IDX_3DD151487294869C');
        $this->addSql('DROP INDEX IDX_3DD15148A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_user AS SELECT article_id, user_id FROM article_user');
        $this->addSql('DROP TABLE article_user');
        $this->addSql('CREATE TABLE article_user (article_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(article_id, user_id), CONSTRAINT FK_3DD151487294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_3DD15148A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article_user (article_id, user_id) SELECT article_id, user_id FROM __temp__article_user');
        $this->addSql('DROP TABLE __temp__article_user');
        $this->addSql('CREATE INDEX IDX_3DD151487294869C ON article_user (article_id)');
        $this->addSql('CREATE INDEX IDX_3DD15148A76ED395 ON article_user (user_id)');
        $this->addSql('DROP INDEX IDX_9474526C14D45BBE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, autor_id, content FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, autor_id INTEGER NOT NULL, article_id INTEGER NOT NULL, content CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_9474526C14D45BBE FOREIGN KEY (autor_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, autor_id, content) SELECT id, autor_id, content FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C14D45BBE ON comment (autor_id)');
        $this->addSql('CREATE INDEX IDX_9474526C7294869C ON comment (article_id)');
        $this->addSql('DROP INDEX IDX_6A2CA10C7294869C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__media AS SELECT id, article_id, path, type FROM media');
        $this->addSql('DROP TABLE media');
        $this->addSql('CREATE TABLE media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL COLLATE BINARY, type VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_6A2CA10C7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO media (id, article_id, path, type) SELECT id, article_id, path, type FROM __temp__media');
        $this->addSql('DROP TABLE __temp__media');
        $this->addSql('CREATE INDEX IDX_6A2CA10C7294869C ON media (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E66C54C8C93');
        $this->addSql('DROP INDEX IDX_23A0E6614D45BBE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, type_id, autor_id, content, titre, is_aprouve, make_at FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, autor_id INTEGER DEFAULT NULL, content CLOB DEFAULT NULL, titre VARCHAR(255) NOT NULL, is_aprouve BOOLEAN DEFAULT NULL, make_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO article (id, type_id, autor_id, content, titre, is_aprouve, make_at) SELECT id, type_id, autor_id, content, titre, is_aprouve, make_at FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E66C54C8C93 ON article (type_id)');
        $this->addSql('CREATE INDEX IDX_23A0E6614D45BBE ON article (autor_id)');
        $this->addSql('DROP INDEX IDX_3DD151487294869C');
        $this->addSql('DROP INDEX IDX_3DD15148A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_user AS SELECT article_id, user_id FROM article_user');
        $this->addSql('DROP TABLE article_user');
        $this->addSql('CREATE TABLE article_user (article_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(article_id, user_id))');
        $this->addSql('INSERT INTO article_user (article_id, user_id) SELECT article_id, user_id FROM __temp__article_user');
        $this->addSql('DROP TABLE __temp__article_user');
        $this->addSql('CREATE INDEX IDX_3DD151487294869C ON article_user (article_id)');
        $this->addSql('CREATE INDEX IDX_3DD15148A76ED395 ON article_user (user_id)');
        $this->addSql('DROP INDEX IDX_9474526C14D45BBE');
        $this->addSql('DROP INDEX IDX_9474526C7294869C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, autor_id, content FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, autor_id INTEGER NOT NULL, content CLOB NOT NULL)');
        $this->addSql('INSERT INTO comment (id, autor_id, content) SELECT id, autor_id, content FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C14D45BBE ON comment (autor_id)');
        $this->addSql('DROP INDEX IDX_6A2CA10C7294869C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__media AS SELECT id, article_id, path, type FROM media');
        $this->addSql('DROP TABLE media');
        $this->addSql('CREATE TABLE media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO media (id, article_id, path, type) SELECT id, article_id, path, type FROM __temp__media');
        $this->addSql('DROP TABLE __temp__media');
        $this->addSql('CREATE INDEX IDX_6A2CA10C7294869C ON media (article_id)');
    }
}