# 🧩 DESAFIO ACCENTURE

![PHP](https://img.shields.io/badge/PHP-8.1-blue?logo=php&logoColor=white)
![Yii2](https://img.shields.io/badge/Yii2-Framework-green?logo=yii&logoColor=white)
![Oracle](https://img.shields.io/badge/Oracle-23c-red?logo=oracle&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple?logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-lightgrey)

> Sistema web desenvolvido com **Yii2 Framework** e **Oracle Database 23c**, contendo CRUDs relacionados, autenticação de usuários com perfis e um processo automatizado para atualização de pedidos.

📦 **Repositório GitHub:** [github.com/dvdt101/desafio-accenture](https://github.com/dvdt101/desafio-accenture)

---

## ⚙️ Descrição do Projeto

O sistema foi desenvolvido com base no desafio técnico de PHP + SQL, possuindo dois módulos principais (**Clients** e **Orders**) e um **processo automatizado (job/cron)** que atualiza pedidos pendentes há mais de 7 dias.

Além disso, foi criado um **módulo extra — Users (Usuários)**, que **não fazia parte do desafio original**, mas foi adicionado para incluir **autenticação e controle de acesso** com perfis de usuários.

---

## 🧱 Estrutura dos Módulos

### **1️⃣ Clients (Clientes)**

Gerencia o cadastro e o status de clientes.

| Campo | Tipo | Tradução | Descrição |
|--------|------|-----------|-----------|
| `ID` | NUMBER(10) | Identificador | Chave primária do cliente. |
| `NAME` | VARCHAR(100) | Nome | Nome completo do cliente. |
| `EMAIL` | VARCHAR(100) | E-mail | E-mail de contato do cliente. |
| `STATUS` | VARCHAR(10) | Status | Pode ser **ATIVO** ou **INATIVO** (default: ATIVO). |
| `CREATED_AT` | TIMESTAMP | Data de cadastro | Data e hora da criação do registro. |

---

### **2️⃣ Orders (Pedidos)**

Gerencia os pedidos vinculados aos clientes.  
💡 **Os campos `TYPE` e `DESCRIPTION` foram adicionados por mim como aprimoramentos ao desafio original**, permitindo categorizar melhor os pedidos e adicionar informações descritivas.

| Campo | Tipo | Tradução | Descrição |
|--------|------|-----------|-----------|
| `ID` | NUMBER(10) | Identificador | Chave primária do pedido. |
| `CLIENT_ID` | INTEGER | Cliente | Chave estrangeira que referencia o cliente. |
| `TOTAL_VALUE` | DECIMAL(10,2) | Valor total | Valor total do pedido. |
| `TYPE` | VARCHAR(10) | Tipo | **Campo adicional criado por mim** – indica o tipo do pedido: **SERVIÇOS**, **MÁQUINAS** ou **PEÇAS**. |
| `DESCRIPTION` | VARCHAR(255) | Descrição | **Campo adicional criado por mim** – permite detalhar o conteúdo do pedido. |
| `STATUS` | VARCHAR(10) | Status | Pode ser **PENDENTE**, **PAGO** ou **CANCELADO**. |
| `ORDER_DATE` | TIMESTAMP | Data do pedido | Data e hora de criação do pedido. |

---

### **3️⃣ Users (Usuários)** 🧩 *(Módulo Extra)*

> Este módulo foi **adicionado por mim** além do escopo original do desafio, para implementar **login e controle de perfis de acesso**.

| Campo | Tipo | Tradução | Descrição |
|--------|------|-----------|-----------|
| `ID` | NUMBER(10) | Identificador | Chave primária do usuário. |
| `USERNAME` | VARCHAR(50) | Nome de usuário | Nome de login usado no sistema. |
| `NAME` | VARCHAR(100) | Nome | Nome completo do usuário. |
| `EMAIL` | VARCHAR(100) | E-mail | E-mail associado. |
| `PASSWORD_HASH` | VARCHAR(100) | Senha criptografada | Hash da senha de acesso. |
| `PROFILE` | VARCHAR(20) | Perfil | Pode ser `ADMINISTRADOR` ou `GESTOR` (default: GESTOR). |
| `STATUS` | VARCHAR(10) | Status | Pode ser **ATIVO** ou **INATIVO** (default: ATIVO). |
| `AUTH_KEY` | VARCHAR(32) | Chave de autenticação | Token interno de autenticação. |
| `ACCESS_TOKEN` | VARCHAR(255) | Token de acesso | Usado para autenticação via API. |
| `CREATED_AT` | TIMESTAMP | Data de criação | Data e hora de criação do usuário. |

---

## 👥 Perfis de Acesso

- **🛠️ ADMINISTRADOR:** acesso total ao sistema, incluindo configurações e gerenciamento.  
- **📊 GESTOR:** acesso limitado às funcionalidades principais (**dashboard**, **clientes** e **pedidos**).

**Usuário padrão criado na instalação:**  
> 🧑‍💻 **USERNAME:** `admin`  
> 🔑 **SENHA:** `admin123`

O login é realizado apenas com **username** e **senha**.

---

## 🔁 Job / Cron Automático

Um comando customizado chamado **`UpdateOrdersController`** executa diariamente para atualizar pedidos pendentes há mais de 7 dias.

### **Descrição**
- Localiza pedidos com status `PENDENTE` há mais de 7 dias.  
- Atualiza o status para `CANCELADO`.  
- Registra logs com data, hora e quantidade de pedidos alterados.

### **Execução Manual**
```bash
php yii update-orders/index
```

### **Logs**
Gerados automaticamente em:
```
runtime/logs/pedidos_cron.log
```

🧾 **Exemplo de log:**
```
[2025-10-25 02:00:00] 5 pedidos atualizados para status 'CANCELADO'
```

---

## 💻 Instalação e Execução

### 📦 Requisitos

- PHP 8.1+  
- Composer  
- Oracle Database 23c  
- Yii2 Framework  
- Extensão **OCI8** ativa  
  > Não é necessário habilitar `pdo_oci`, pois é utilizada a biblioteca  
  > `pdynarowski\yii2oci8\Oci8Connection` para conexão Oracle.

---

### ⚙️ Configuração do Banco de Dados

O arquivo `config/db.example` deve ser renomeado para `db.php` e configurado conforme seu ambiente:

```php
<?php
return [
    'class' => \pdynarowski\yii2oci8\Oci8Connection::class,
    'dsn' => 'oci:dbname=//ORACLE_DOMAIN:1521/ORACLE_PDB;charset=AL32UTF8',
    'username' => 'DESAFIO_ACCENTURE',
    'password' => 'USER_PASSWORD',
    'charset'  => 'AL32UTF8',
];
```

---

### 🚀 Rodando o Projeto

1. **Clonar o repositório**
   ```bash
   git clone https://github.com/dvdt101/desafio-accenture.git
   cd desafio-accenture
   ```

2. **Instalar dependências**
   ```bash
   composer install
   ```

3. **Configurar o banco**
   ```bash
   cp config/db.example config/db.php
   ```
   Edite o arquivo `db.php` com suas credenciais Oracle.

4. **Executar migrations**
   ```bash
   php yii migrate
   ```

5. **Rodar o servidor**
   ```bash
   php yii serve
   ```
   👉 Acesse: [http://localhost:8080](http://localhost:8080)

---

## 🧠 Tecnologias Utilizadas

✅ PHP 8.1  
✅ Yii2 Framework  
✅ Oracle 23c  
✅ AdminLTE Template  
✅ Bootstrap 5  
✅ pdynarowski/yii2-oci8  
✅ Launchctl / Cron Jobs

---

## ⏱️ Tempo de Desenvolvimento

| Etapa | Tempo |
|-------|--------|
| Estruturação e setup do Yii2 | 3h |
| CRUDs (Clients, Orders e Users) | 8h |
| Integração com Oracle | 4h |
| Implementação do Job e logs | 4h |
| Sistema de login e perfis | 3h |
| Testes e ajustes finais | 2h |

🕒 **Total:** 24 horas

---

## 👨‍💻 Autor

**David Tavares Fernandes da Silva**  
Desenvolvedor Full Stack • Recife – PE  
🌐 [dtavaresfs.com](https://dtavaresfs.com)  
💼 [LinkedIn](https://www.linkedin.com/in/dtavaresfs/)
