Documentation du projet.

Utilisation de l'API

1. Liste des routes : 
  /getArticles, /addPanier, /removePanier, /getPanier, /getUser, /getMenu

2. Détails des routes :
  /getArticles : 
    Requête GET, retourne sous format JSON la liste complète des articles en ventes sur le site avec leurs descriptif complet.
  
  /addPanier/{id} :
    Requête GET, option {id} correspondant à l'id d'un article.
    Ajoute l'article correspondant à l'id dans le panier.
    Retourne true si l'article est ajouté, sinon retourne false
    
  /removePanier/{id} :
    Requête GET, option {id} correspondant à l'id d'un article.
    Retire l'article correspondant à l'id dans le panier.
    Retourne true si l'article est retiré, sinon retourne false
    
  /getPanier :
    Requête GET, retourne sous format JSON le panier de l'utilisateur enregistré en variable de session.
    
  /getUser :
    Requête GET, retourne sous format JSON toutes les informations sur l'utilisateur actuellement connecté.
    
  /getMenu/{id} :
    Requête GET,  option {id} correspondant à l'id d'un menu.
    Retourne sous format JSON les informations du menu passer en paramètre.
