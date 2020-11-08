# Mediacenter

- **Plex** : Streaming films & séries. ([plex.pi.chinour.fr](https://plex.pi.chinour.fr))
- **Transmission** : Téléchargement des torrents. ([torrent.pi.chinour.fr](https://torrent.pi.chinour.fr))

## Installation

1. Copier ce répertoire dans le répertoire applicatif : `/applications`
2. Monter le disque médiacenter dans `/mediastorage`
3. Créer l'utilisateur `mediacenter` avec le uid `1200` : `sudo useradd -u 1200 mediacenter`.
5. Pour valider la connexion avec Plex il faut mettre à jour la variable d'environnement PLEX_CLAIM avec un claim récupérable [ici](https://www.plex.tv/claim/).

