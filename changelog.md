# Change log

16/07/2022
- Ajout des commandes suivantes : 
  - Detection de mouvement / Alarme
    - Sensibilité par défaut (cameras AI ET non-AI)
    - Sensibilité Detection intelligente Personne (cameras AI)
    - Sensibilité Detection intelligente Véhicule (cameras AI)
    - Delai d'alarme Personne (cameras AI)
    - Delai d'alarme Véhicule (cameras AI)
  - PTZGuard [Point de garde] (3)
    - Etat du point de garde
    - Création/Actualisation du point de garde
    - Activation/Désactivation du retour auto. au point de garde
    - Réglage du délai de retour auto. au point de garde

(3): Ne fonctionne qu'avec les Cameras AI ayant la fonctionnalité (Ability) "ptzPreset" ET les commandes Get(Set)PtzGuard intégrées aux firmwares : E1Outdoor, RLC-523WA et RLC-823A UNIQUEMENT

12/06/2022
- Merge Pull request depuis @Micka41 (Ajout de la commande Mode led blanche)

10/06/2022
- Sur la page équipement : ajout des informations des ports, et s'il sont activés ou pas (si la caméra remonte l'information)
- Daemon : ajout de vérification supplémentaire pour contrôler si la caméra répond au ping, et si le port ONVIF est actif.
- Divers bugs fix

01/06/2022
- Ajout des options de configuration suivantes :
    - Taille des block commandes
    - IP de callback du webhook
    - Port du webhook
- Modification/Ajout d'information dans le README
- Suppression des imports inutiles du daemon

31/05/2022
- Merge Pull request depuis @Micka41 (ajout de la commande TrackAI)
- Modification log level sur le daemon
- Correction détail dans info.json

30/05/2022
- Passage Jeedom stable

31/03/2022
- Ajout des commandes suivantes :
  - Calibration de la camera (2)
    - Etat de la calibration
    - Exécution de la calibration
  - Gestion de la sirène (1)
    - Déclenchement manuel de la sirène
    - Volume de la sirène
  - Upnp
  - P2p 

(1): Ne fonctionne qu'avec les Cameras ayant la fonctionnalité (Ability) "supportAudioAlarm" \
(2): Ne fonctionne qu'avec les Cameras ayant la fonctionnalité (Ability) "supportPtzCheck" : E1Outdoor, RLC-523WA et RLC-823A UNIQUEMENT

11/03/2022
- Ajout d'un daemon permettre la souscription aux évènements ONVIF (détection de mouvement en temps réel)

05/03/2022
- Ajout des commandes de monitoring de la caméra : Utilisation CPU, Débit codec et Débit réseau

27/02/2022
- Merge Pull request depuis @mnpg (ajout de commandes AI)

20/02/2022
- Refonte de la gestion du refresh du plugin
- Détection ou non si la caméra est IA (adaptation des commandes en fonction)
- Bug fix

30/01/2022
- Bug fix masque vie privée état non remontée
- Bug fix Enregistrement : Pre/Post/Overwrite état non remontée
- Ajout support Led Blanche
