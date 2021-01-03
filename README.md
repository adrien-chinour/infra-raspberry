# Infra Raspberry

## Requirements

- Docker et docker-compose

## Installation

### Configuration Traefik

1. Créer le network traefik sous docker : `docker network create traefik_network`

2. Dans le répertoire traefik le fichier `traefik.yaml` et le répertoire `custom` contienne la configuration traefik :

```yaml
# traefik.yaml
certificatesResolvers:
    myresolver:
        acme:
            email: 'postmaster@chinour.fr' # à modifier
            storage: '/letsencrypt/acme.json'
            tlsChallenge: 'true'
```

3. Aucune autre modification n'est nécessaire pour faire tourner traefik.
   **Cependant attention le dashboard est activé en mode insecure par défaut.**

```yaml
# traefik.yaml
api:
    dashboard: true
    insecure: true
```

4. Démarrer le service : `docker-compose up -d`

### Configuration Mediacenter

1. Créer l'utilisateur **mediacenter** avec le uid **1200** : `sudo useradd -u 1200 mediacenter`.
2. Créer le volume */mediastorage* pour la persistance des médias (films, séries, etc).
3. Mettre à jour les droits sur */mediastorage* : `chown mediacenter:mediacenter /mediastorage`

> Un répertoire */mediastorage/films* contient la bibliothèque de films et */mediastorage/series* les séries.

4. Copier le fichier `config/transmission/settings.json.dist` dans `config/transmission/settings.json`
   et modifier l'identifiant et le mot de passe

5. Copier `.env.dist` dans `.env` et mettre à jour les variables.
6. Démarrer le service : `docker-compose up -d`

> Pour valider la connexion avec Plex il faut mettre à jour la variable d'environnement PLEX_CLAIM
> avec un claim récupérable [ici](https://www.plex.tv/claim/).

### Configuration Nextcloud

1. Créer l'utilisateur `nextcloud` avec le uid `1300` : `sudo useradd -u 1300 nextcloud`.
2. Créer le volume `/cloud` pour la persistance des fichiers nextcloud (data).
3. Mettre à jour les droits sur `/cloud`: `chown nextcloud:nextcloud /cloud`

> Un volume docker `nextcloud_html` contient le volume `/var/www/html` du conteneur.
> Pour permettre un accès simple `/var/www/html/data` est dans un volume différent.

4. Copier `.env.dist` dans `.env` et mettre à jour les variables.
5. Démarrer le service : `docker-compose up -d`

> Lors du premier démarrage l'utilisateur admin est créé.

## A venir

- [x] Ajouter un middleware d'authentification pour les services mediacenter
- [x] Ajouter **Sonarr** et **Radarr**
- [ ] Ajouter un service de partage (sur */mediastorage* pour profiter de transmission)
- [ ] Ajouter un CLI pour administrer les services
- [ ] Tableau de bord personnalisé (état des disques, accès aux services, accès aux logs)
