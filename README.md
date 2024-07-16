# Tweeter grace à PHP et MongoDB
<div align=center>
<img src="https://media.istockphoto.com/id/1337229983/fr/photo/symbole-de-bulle-ou-de-signe-de-commentaire-sur-fond-jaune.jpg?s=2048x2048&w=is&k=20&c=ZKILp1ZeypAQcBqZVcsrWNnFkn5xUMPf2ZcOBjIo_rI=" alt="bulles de discussion" width="70px" />
</div>
## Description
Bienvenue sur la plateforme de micro-blogging où vous pouvez :

- Vous connecter et partager vos pensées en 280 caractères ou moins.
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
