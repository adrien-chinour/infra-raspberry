# Mediacenter

- **Plex** : Streaming films & séries. ([plex.chinour.fr](https://plex.chinour.fr))
- **Transmission** : Téléchargement des torrents. ([torrent.chinour.fr](https://torrent.chinour.fr))

## Installation

1. Copier ce répertoire dans le répertoire applicatif : `/applications`
2. Monter le disque médiacenter dans `/mediastorage`
3. Créer l'utilisateur `mediacenter` et modifier le `docker-compose.yml` avec les bons UID et GID.
4. Une fois les services up il ets nécessaire d'activer l'accès à distance de Plex : `ssh user@IP_SERVER -L 32400:localhost:32400`