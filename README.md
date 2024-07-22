# Tweeter grace à PHP et MongoDB
<div align=center>
<img src="https://media.istockphoto.com/id/1337229983/fr/photo/symbole-de-bulle-ou-de-signe-de-commentaire-sur-fond-jaune.jpg?s=2048x2048&w=is&k=20&c=ZKILp1ZeypAQcBqZVcsrWNnFkn5xUMPf2ZcOBjIo_rI=" alt="bulles de discussion" width="150px" />
</div>

## Description

Bienvenue sur la plateforme de micro-blogging où vous pouvez :

-  Vous inscrire en toute sécurité
- Vous connecter et partager vos pensées.
- Découvrir les tweets d'une communauté d'utilisateurs passionnés.
- Suivre vos amis, votre famille et vos célébrités préférées.
- Interagir avec les autres en retweetant, en commentant et en aimant leurs tweets.
- Modifier ou supprimer vos propres tweets à tout moment.
## Pré-requis
PHP 8.1
MongoDB
## Installation

# Étape 1 : Télécharger MongoDB

Pour installer MongoDB, vous devez d'abord télécharger la version appropriée pour votre système d'exploitation depuis le site officiel de MongoDB : [Télécharger MongoDB](https://www.mongodb.com/try/download/community).

### Étape 2 : Installer MongoDB

Une fois téléchargé, suivez les instructions spécifiques à votre système d'exploitation pour installer MongoDB.

**Pour Windows :**

1. Exécutez le fichier d'installation téléchargé.
2. Suivez les étapes de l'assistant d'installation.
3. Assurez-vous d'ajouter MongoDB à votre PATH pour faciliter son utilisation en ligne de commande.

**Pour macOS :**

Utilisez Homebrew pour installer MongoDB :

```bash
brew tap mongodb/brew
brew install mongodb-community@5.0
# Démarrez le service MongoDB
brew services start mongodb/brew/mongodb-community
```

**Pour Linux :**
Suivez les instructions spécifiques à votre distribution sur le site officiel.

### MongoDB Shell ou compass
Si vous avez une préférence pous les lignes de commandes téléchargez MongoDB Shell:
https://www.mongodb.com/try/download/shell
**Compass:**
# Utilisation de MongoDB Compass

MongoDB Compass est une interface graphique pour MongoDB qui permet de visualiser, explorer et manipuler les données de manière intuitive. Ce chapitre vous guidera à travers l'installation, la configuration et l'utilisation de MongoDB Compass pour gérer vos bases de données MongoDB.

### Connexion à une base de données MongoDB

1. **Lancer MongoDB Compass :** Ouvrez MongoDB Compass depuis votre menu des applications.
2. **Ajouter une nouvelle connexion :**
    - Cliquez sur "New Connection" ou "Connect".
    - Entrez l'URI de connexion de votre serveur MongoDB. Par exemple, pour une installation locale, l'URI par défaut est `mongodb://localhost:27017`.
    - Cliquez sur "Connect" pour établir la connexion.

### Interface principale de MongoDB Compass

Une fois connecté, l'interface principale de MongoDB Compass s'affiche, comprenant plusieurs sections :

- **Bases de données et collections :** Liste des bases de données et collections disponibles.
- **Exploration des documents :** Permet de visualiser, filtrer, trier et analyser les documents.
- **Indexation :** Visualisation et gestion des index.
- **Statistiques de performance :** Analyse des performances de la base de données.
