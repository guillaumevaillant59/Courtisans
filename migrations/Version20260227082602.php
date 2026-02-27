<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260227082602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, famille VARCHAR(30) NOT NULL, role VARCHAR(30) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE disgrace (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE disgrace_papillon (disgrace_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_8F8640EF464D262D (disgrace_id), INDEX IDX_8F8640EFC9C7CEB6 (carte_id), PRIMARY KEY (disgrace_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE disgrace_crapaud (disgrace_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_4B5BD316464D262D (disgrace_id), INDEX IDX_4B5BD316C9C7CEB6 (carte_id), PRIMARY KEY (disgrace_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE disgrace_rossignol (disgrace_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_9DDE984464D262D (disgrace_id), INDEX IDX_9DDE984C9C7CEB6 (carte_id), PRIMARY KEY (disgrace_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE disgrace_espion (disgrace_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_54E0A7AD464D262D (disgrace_id), INDEX IDX_54E0A7ADC9C7CEB6 (carte_id), PRIMARY KEY (disgrace_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE disgrace_cerf (disgrace_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_6459DEEA464D262D (disgrace_id), INDEX IDX_6459DEEAC9C7CEB6 (carte_id), PRIMARY KEY (disgrace_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE disgrace_lapin (disgrace_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_B19D394D464D262D (disgrace_id), INDEX IDX_B19D394DC9C7CEB6 (carte_id), PRIMARY KEY (disgrace_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE disgrace_carpe (disgrace_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_3C9B0A62464D262D (disgrace_id), INDEX IDX_3C9B0A62C9C7CEB6 (carte_id), PRIMARY KEY (disgrace_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domaine_joueur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domainejoueur_papillon (domaine_joueur_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_8CFCCA61BF3979AC (domaine_joueur_id), INDEX IDX_8CFCCA61C9C7CEB6 (carte_id), PRIMARY KEY (domaine_joueur_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domainejoueur_crapaud (domaine_joueur_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_87335194BF3979AC (domaine_joueur_id), INDEX IDX_87335194C9C7CEB6 (carte_id), PRIMARY KEY (domaine_joueur_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domainejoueur_rossignol (domaine_joueur_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_3DE3D29BF3979AC (domaine_joueur_id), INDEX IDX_3DE3D29C9C7CEB6 (carte_id), PRIMARY KEY (domaine_joueur_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domainejoueur_cerf (domaine_joueur_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_BFB864EDBF3979AC (domaine_joueur_id), INDEX IDX_BFB864EDC9C7CEB6 (carte_id), PRIMARY KEY (domaine_joueur_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domainejoueur_lapin (domaine_joueur_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_2F224D54BF3979AC (domaine_joueur_id), INDEX IDX_2F224D54C9C7CEB6 (carte_id), PRIMARY KEY (domaine_joueur_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domainejoueur_carpe (domaine_joueur_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_A2247E7BBF3979AC (domaine_joueur_id), INDEX IDX_A2247E7BC9C7CEB6 (carte_id), PRIMARY KEY (domaine_joueur_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domainejoueur_espion (domaine_joueur_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_3015B019BF3979AC (domaine_joueur_id), INDEX IDX_3015B019C9C7CEB6 (carte_id), PRIMARY KEY (domaine_joueur_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE domaine_reine (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, lumiere_id INT NOT NULL, disgrace_id INT NOT NULL, UNIQUE INDEX UNIQ_21207A9B8976801B (lumiere_id), UNIQUE INDEX UNIQ_21207A9B464D262D (disgrace_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, points INT DEFAULT NULL, position INT NOT NULL, utilisateur_id INT NOT NULL, partie_id INT NOT NULL, main_id INT DEFAULT NULL, domaine_id INT DEFAULT NULL, mission_blanche_id INT DEFAULT NULL, mission_bleue_id INT DEFAULT NULL, INDEX IDX_FD71A9C5FB88E14F (utilisateur_id), INDEX IDX_FD71A9C5E075F7A4 (partie_id), UNIQUE INDEX UNIQ_FD71A9C5627EA78A (main_id), UNIQUE INDEX UNIQ_FD71A9C54272FC9F (domaine_id), INDEX IDX_FD71A9C5BBDD2EE6 (mission_blanche_id), INDEX IDX_FD71A9C54FF5B5C2 (mission_bleue_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lumiere (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lumiere_papillons (lumiere_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_D71DA3FE8976801B (lumiere_id), INDEX IDX_D71DA3FEC9C7CEB6 (carte_id), PRIMARY KEY (lumiere_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lumiere_crapaud (lumiere_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_696619198976801B (lumiere_id), INDEX IDX_69661919C9C7CEB6 (carte_id), PRIMARY KEY (lumiere_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lumiere_rossignol (lumiere_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_F5F4FCD88976801B (lumiere_id), INDEX IDX_F5F4FCD8C9C7CEB6 (carte_id), PRIMARY KEY (lumiere_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lumiere_espion (lumiere_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_6B3C111B8976801B (lumiere_id), INDEX IDX_6B3C111BC9C7CEB6 (carte_id), PRIMARY KEY (lumiere_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lumiere_cerf (lumiere_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_D2F086798976801B (lumiere_id), INDEX IDX_D2F08679C9C7CEB6 (carte_id), PRIMARY KEY (lumiere_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lumiere_lapin (lumiere_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_D82D52EB8976801B (lumiere_id), INDEX IDX_D82D52EBC9C7CEB6 (carte_id), PRIMARY KEY (lumiere_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lumiere_carpe (lumiere_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_552B61C48976801B (lumiere_id), INDEX IDX_552B61C4C9C7CEB6 (carte_id), PRIMARY KEY (lumiere_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE main_joueur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE main_joueur_carte (main_joueur_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_7BD9F342895470CE (main_joueur_id), INDEX IDX_7BD9F342C9C7CEB6 (carte_id), PRIMARY KEY (main_joueur_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE mission_blanche (id INT AUTO_INCREMENT NOT NULL, objectif VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE mission_bleue (id INT AUTO_INCREMENT NOT NULL, objectif VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, nombre_joueur_max INT NOT NULL, status VARCHAR(10) NOT NULL, domaine_reine_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_59B1F3D79B923B4 (domaine_reine_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE partie_carte (partie_id INT NOT NULL, carte_id INT NOT NULL, INDEX IDX_632A30FE075F7A4 (partie_id), INDEX IDX_632A30FC9C7CEB6 (carte_id), PRIMARY KEY (partie_id, carte_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE disgrace_papillon ADD CONSTRAINT FK_8F8640EF464D262D FOREIGN KEY (disgrace_id) REFERENCES disgrace (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_papillon ADD CONSTRAINT FK_8F8640EFC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_crapaud ADD CONSTRAINT FK_4B5BD316464D262D FOREIGN KEY (disgrace_id) REFERENCES disgrace (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_crapaud ADD CONSTRAINT FK_4B5BD316C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_rossignol ADD CONSTRAINT FK_9DDE984464D262D FOREIGN KEY (disgrace_id) REFERENCES disgrace (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_rossignol ADD CONSTRAINT FK_9DDE984C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_espion ADD CONSTRAINT FK_54E0A7AD464D262D FOREIGN KEY (disgrace_id) REFERENCES disgrace (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_espion ADD CONSTRAINT FK_54E0A7ADC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_cerf ADD CONSTRAINT FK_6459DEEA464D262D FOREIGN KEY (disgrace_id) REFERENCES disgrace (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_cerf ADD CONSTRAINT FK_6459DEEAC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_lapin ADD CONSTRAINT FK_B19D394D464D262D FOREIGN KEY (disgrace_id) REFERENCES disgrace (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_lapin ADD CONSTRAINT FK_B19D394DC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_carpe ADD CONSTRAINT FK_3C9B0A62464D262D FOREIGN KEY (disgrace_id) REFERENCES disgrace (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disgrace_carpe ADD CONSTRAINT FK_3C9B0A62C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_papillon ADD CONSTRAINT FK_8CFCCA61BF3979AC FOREIGN KEY (domaine_joueur_id) REFERENCES domaine_joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_papillon ADD CONSTRAINT FK_8CFCCA61C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_crapaud ADD CONSTRAINT FK_87335194BF3979AC FOREIGN KEY (domaine_joueur_id) REFERENCES domaine_joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_crapaud ADD CONSTRAINT FK_87335194C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_rossignol ADD CONSTRAINT FK_3DE3D29BF3979AC FOREIGN KEY (domaine_joueur_id) REFERENCES domaine_joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_rossignol ADD CONSTRAINT FK_3DE3D29C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_cerf ADD CONSTRAINT FK_BFB864EDBF3979AC FOREIGN KEY (domaine_joueur_id) REFERENCES domaine_joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_cerf ADD CONSTRAINT FK_BFB864EDC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_lapin ADD CONSTRAINT FK_2F224D54BF3979AC FOREIGN KEY (domaine_joueur_id) REFERENCES domaine_joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_lapin ADD CONSTRAINT FK_2F224D54C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_carpe ADD CONSTRAINT FK_A2247E7BBF3979AC FOREIGN KEY (domaine_joueur_id) REFERENCES domaine_joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_carpe ADD CONSTRAINT FK_A2247E7BC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_espion ADD CONSTRAINT FK_3015B019BF3979AC FOREIGN KEY (domaine_joueur_id) REFERENCES domaine_joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domainejoueur_espion ADD CONSTRAINT FK_3015B019C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domaine_reine ADD CONSTRAINT FK_21207A9B8976801B FOREIGN KEY (lumiere_id) REFERENCES lumiere (id)');
        $this->addSql('ALTER TABLE domaine_reine ADD CONSTRAINT FK_21207A9B464D262D FOREIGN KEY (disgrace_id) REFERENCES disgrace (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5627EA78A FOREIGN KEY (main_id) REFERENCES main_joueur (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C54272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine_joueur (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5BBDD2EE6 FOREIGN KEY (mission_blanche_id) REFERENCES mission_blanche (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C54FF5B5C2 FOREIGN KEY (mission_bleue_id) REFERENCES mission_bleue (id)');
        $this->addSql('ALTER TABLE lumiere_papillons ADD CONSTRAINT FK_D71DA3FE8976801B FOREIGN KEY (lumiere_id) REFERENCES lumiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_papillons ADD CONSTRAINT FK_D71DA3FEC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_crapaud ADD CONSTRAINT FK_696619198976801B FOREIGN KEY (lumiere_id) REFERENCES lumiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_crapaud ADD CONSTRAINT FK_69661919C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_rossignol ADD CONSTRAINT FK_F5F4FCD88976801B FOREIGN KEY (lumiere_id) REFERENCES lumiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_rossignol ADD CONSTRAINT FK_F5F4FCD8C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_espion ADD CONSTRAINT FK_6B3C111B8976801B FOREIGN KEY (lumiere_id) REFERENCES lumiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_espion ADD CONSTRAINT FK_6B3C111BC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_cerf ADD CONSTRAINT FK_D2F086798976801B FOREIGN KEY (lumiere_id) REFERENCES lumiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_cerf ADD CONSTRAINT FK_D2F08679C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_lapin ADD CONSTRAINT FK_D82D52EB8976801B FOREIGN KEY (lumiere_id) REFERENCES lumiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_lapin ADD CONSTRAINT FK_D82D52EBC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_carpe ADD CONSTRAINT FK_552B61C48976801B FOREIGN KEY (lumiere_id) REFERENCES lumiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lumiere_carpe ADD CONSTRAINT FK_552B61C4C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE main_joueur_carte ADD CONSTRAINT FK_7BD9F342895470CE FOREIGN KEY (main_joueur_id) REFERENCES main_joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE main_joueur_carte ADD CONSTRAINT FK_7BD9F342C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D79B923B4 FOREIGN KEY (domaine_reine_id) REFERENCES domaine_reine (id)');
        $this->addSql('ALTER TABLE partie_carte ADD CONSTRAINT FK_632A30FE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_carte ADD CONSTRAINT FK_632A30FC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disgrace_papillon DROP FOREIGN KEY FK_8F8640EF464D262D');
        $this->addSql('ALTER TABLE disgrace_papillon DROP FOREIGN KEY FK_8F8640EFC9C7CEB6');
        $this->addSql('ALTER TABLE disgrace_crapaud DROP FOREIGN KEY FK_4B5BD316464D262D');
        $this->addSql('ALTER TABLE disgrace_crapaud DROP FOREIGN KEY FK_4B5BD316C9C7CEB6');
        $this->addSql('ALTER TABLE disgrace_rossignol DROP FOREIGN KEY FK_9DDE984464D262D');
        $this->addSql('ALTER TABLE disgrace_rossignol DROP FOREIGN KEY FK_9DDE984C9C7CEB6');
        $this->addSql('ALTER TABLE disgrace_espion DROP FOREIGN KEY FK_54E0A7AD464D262D');
        $this->addSql('ALTER TABLE disgrace_espion DROP FOREIGN KEY FK_54E0A7ADC9C7CEB6');
        $this->addSql('ALTER TABLE disgrace_cerf DROP FOREIGN KEY FK_6459DEEA464D262D');
        $this->addSql('ALTER TABLE disgrace_cerf DROP FOREIGN KEY FK_6459DEEAC9C7CEB6');
        $this->addSql('ALTER TABLE disgrace_lapin DROP FOREIGN KEY FK_B19D394D464D262D');
        $this->addSql('ALTER TABLE disgrace_lapin DROP FOREIGN KEY FK_B19D394DC9C7CEB6');
        $this->addSql('ALTER TABLE disgrace_carpe DROP FOREIGN KEY FK_3C9B0A62464D262D');
        $this->addSql('ALTER TABLE disgrace_carpe DROP FOREIGN KEY FK_3C9B0A62C9C7CEB6');
        $this->addSql('ALTER TABLE domainejoueur_papillon DROP FOREIGN KEY FK_8CFCCA61BF3979AC');
        $this->addSql('ALTER TABLE domainejoueur_papillon DROP FOREIGN KEY FK_8CFCCA61C9C7CEB6');
        $this->addSql('ALTER TABLE domainejoueur_crapaud DROP FOREIGN KEY FK_87335194BF3979AC');
        $this->addSql('ALTER TABLE domainejoueur_crapaud DROP FOREIGN KEY FK_87335194C9C7CEB6');
        $this->addSql('ALTER TABLE domainejoueur_rossignol DROP FOREIGN KEY FK_3DE3D29BF3979AC');
        $this->addSql('ALTER TABLE domainejoueur_rossignol DROP FOREIGN KEY FK_3DE3D29C9C7CEB6');
        $this->addSql('ALTER TABLE domainejoueur_cerf DROP FOREIGN KEY FK_BFB864EDBF3979AC');
        $this->addSql('ALTER TABLE domainejoueur_cerf DROP FOREIGN KEY FK_BFB864EDC9C7CEB6');
        $this->addSql('ALTER TABLE domainejoueur_lapin DROP FOREIGN KEY FK_2F224D54BF3979AC');
        $this->addSql('ALTER TABLE domainejoueur_lapin DROP FOREIGN KEY FK_2F224D54C9C7CEB6');
        $this->addSql('ALTER TABLE domainejoueur_carpe DROP FOREIGN KEY FK_A2247E7BBF3979AC');
        $this->addSql('ALTER TABLE domainejoueur_carpe DROP FOREIGN KEY FK_A2247E7BC9C7CEB6');
        $this->addSql('ALTER TABLE domainejoueur_espion DROP FOREIGN KEY FK_3015B019BF3979AC');
        $this->addSql('ALTER TABLE domainejoueur_espion DROP FOREIGN KEY FK_3015B019C9C7CEB6');
        $this->addSql('ALTER TABLE domaine_reine DROP FOREIGN KEY FK_21207A9B8976801B');
        $this->addSql('ALTER TABLE domaine_reine DROP FOREIGN KEY FK_21207A9B464D262D');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5FB88E14F');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5E075F7A4');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5627EA78A');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C54272FC9F');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5BBDD2EE6');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C54FF5B5C2');
        $this->addSql('ALTER TABLE lumiere_papillons DROP FOREIGN KEY FK_D71DA3FE8976801B');
        $this->addSql('ALTER TABLE lumiere_papillons DROP FOREIGN KEY FK_D71DA3FEC9C7CEB6');
        $this->addSql('ALTER TABLE lumiere_crapaud DROP FOREIGN KEY FK_696619198976801B');
        $this->addSql('ALTER TABLE lumiere_crapaud DROP FOREIGN KEY FK_69661919C9C7CEB6');
        $this->addSql('ALTER TABLE lumiere_rossignol DROP FOREIGN KEY FK_F5F4FCD88976801B');
        $this->addSql('ALTER TABLE lumiere_rossignol DROP FOREIGN KEY FK_F5F4FCD8C9C7CEB6');
        $this->addSql('ALTER TABLE lumiere_espion DROP FOREIGN KEY FK_6B3C111B8976801B');
        $this->addSql('ALTER TABLE lumiere_espion DROP FOREIGN KEY FK_6B3C111BC9C7CEB6');
        $this->addSql('ALTER TABLE lumiere_cerf DROP FOREIGN KEY FK_D2F086798976801B');
        $this->addSql('ALTER TABLE lumiere_cerf DROP FOREIGN KEY FK_D2F08679C9C7CEB6');
        $this->addSql('ALTER TABLE lumiere_lapin DROP FOREIGN KEY FK_D82D52EB8976801B');
        $this->addSql('ALTER TABLE lumiere_lapin DROP FOREIGN KEY FK_D82D52EBC9C7CEB6');
        $this->addSql('ALTER TABLE lumiere_carpe DROP FOREIGN KEY FK_552B61C48976801B');
        $this->addSql('ALTER TABLE lumiere_carpe DROP FOREIGN KEY FK_552B61C4C9C7CEB6');
        $this->addSql('ALTER TABLE main_joueur_carte DROP FOREIGN KEY FK_7BD9F342895470CE');
        $this->addSql('ALTER TABLE main_joueur_carte DROP FOREIGN KEY FK_7BD9F342C9C7CEB6');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D79B923B4');
        $this->addSql('ALTER TABLE partie_carte DROP FOREIGN KEY FK_632A30FE075F7A4');
        $this->addSql('ALTER TABLE partie_carte DROP FOREIGN KEY FK_632A30FC9C7CEB6');
        $this->addSql('DROP TABLE carte');
        $this->addSql('DROP TABLE disgrace');
        $this->addSql('DROP TABLE disgrace_papillon');
        $this->addSql('DROP TABLE disgrace_crapaud');
        $this->addSql('DROP TABLE disgrace_rossignol');
        $this->addSql('DROP TABLE disgrace_espion');
        $this->addSql('DROP TABLE disgrace_cerf');
        $this->addSql('DROP TABLE disgrace_lapin');
        $this->addSql('DROP TABLE disgrace_carpe');
        $this->addSql('DROP TABLE domaine_joueur');
        $this->addSql('DROP TABLE domainejoueur_papillon');
        $this->addSql('DROP TABLE domainejoueur_crapaud');
        $this->addSql('DROP TABLE domainejoueur_rossignol');
        $this->addSql('DROP TABLE domainejoueur_cerf');
        $this->addSql('DROP TABLE domainejoueur_lapin');
        $this->addSql('DROP TABLE domainejoueur_carpe');
        $this->addSql('DROP TABLE domainejoueur_espion');
        $this->addSql('DROP TABLE domaine_reine');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE lumiere');
        $this->addSql('DROP TABLE lumiere_papillons');
        $this->addSql('DROP TABLE lumiere_crapaud');
        $this->addSql('DROP TABLE lumiere_rossignol');
        $this->addSql('DROP TABLE lumiere_espion');
        $this->addSql('DROP TABLE lumiere_cerf');
        $this->addSql('DROP TABLE lumiere_lapin');
        $this->addSql('DROP TABLE lumiere_carpe');
        $this->addSql('DROP TABLE main_joueur');
        $this->addSql('DROP TABLE main_joueur_carte');
        $this->addSql('DROP TABLE mission_blanche');
        $this->addSql('DROP TABLE mission_bleue');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE partie_carte');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
