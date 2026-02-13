# 🧪 Lab 02 – Déploiement d’une application PHP / MySQL avec Docker Compose

## 📌 Présentation du projet

Ce projet démontre le **déploiement d’une application PHP connectée à une base de données MySQL**
en utilisant **Docker et Docker Compose**.

L’application PHP est volontairement **simple (page de test avec connexion à la base de données)**.
L’objectif principal n’est pas la complexité applicative, mais la **mise en œuvre des bonnes pratiques
de conteneurisation**, la séparation des services et l’orchestration via Docker Compose.

Ce type d’architecture est **très courant en environnement professionnel**, notamment pour
des applications PHP existantes ou des projets web simples.

---

## 🎯 Objectifs techniques

- Conteneuriser une application PHP
- Déployer MySQL comme service Docker
- Orchestrer les services avec Docker Compose
- Assurer la communication inter-services via un réseau Docker interne
- Mettre en place la persistance des données MySQL avec un volume
- Utiliser des variables d’environnement pour la configuration

<!-- Captures d’écran à ajouter si besoin -->
<!--
<img src="..." />
-->

---

## 🧱 Architecture

L’architecture repose sur deux services définis dans le fichier `docker-compose.yml`.

Utilisateur  
│  
▼  
[ Application PHP ]  
│  
▼  
[ MySQL ]

---

### Principes appliqués

- Un conteneur par service
- Réseau Docker interne pour la communication
- Séparation application / base de données
- Persistance des données MySQL via volume
- Architecture simple, reproductible et portable

---

## 🛠️ Stack technique

- Docker
- Docker Compose
- PHP
- MySQL
- Linux

---

## ⚙️ Exécution et déploiement du projet

### ✅ Prérequis

- Docker
- Docker Compose
- Git

---

### 🚀 Étapes détaillées

```bash
docker build -t phpapps:v1 .
docker compose up -p
docker compose ps

http://localhost:8080/
 identifiant: admin
 paswword: admin
```
### Nettoyage
```bash
docker compose down -v
```