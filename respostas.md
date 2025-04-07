### 1.  Vue.js
Explique como funciona o ciclo de vida de um componente em Vue.js e como isso influencia na
performance de uma aplicação.
- Resposta: O ciclo de vida de um componente Vue.js consiste em uma série de funções (hooks) que são executados em momentos específicos durante a existência do componente.

#### Principais Hooks do lifecycle:

    1. Inicialização: 
        - beforeCreate: O componente foi inicializado, mas a observação de dados e eventos ainda não começou
        - created: O componente foi criado, dados são observáveis, mas o DOM ainda não existe
    2. Montagem: 
        - beforeMount: Antes do componente ser montado no DOM
        - mounted: O componente foi montado no DOM e está visível na página 
    3. Atualização:
        - beforeUpdate: Antes de atualizar o DOM após mudanças nos dados
        - updated: Após o DOM ser atualizado com as novas alterações
    4. Desmontagem:
        - beforeUnmount: Antes do componente ser removido do DOM
        - unmounted: Após o componente ser removido

#### Performance:
  - A performance de uma aplicação Vue.js é influenciada pelo uso eficiente dos hooks do ciclo de vida. Evite operações pesadas nos hooks iniciais (created, mounted) para não atrasar a renderização. Minimize manipulações desnecessárias no DOM durante atualizações (beforeUpdate, updated) e limpe recursos no hook de desmontagem (beforeUnmount). Utilize técnicas como divisão de componentes, lazy loading e reatividade eficiente para otimizar o desempenho.


### 2. Laravel + Vue.js
Em aplicações Laravel + Vue.js, qual é a melhor abordagem para lidar com autenticação entre o
frontend e o backend? Explique um fluxo seguro para login, armazenando tokens e a
comunicação entre as camadas.
- Resposta: Bom, normalmente já gosto de utilizar as implementações padrão do laravel para autenticação, utilizando o Breeze. Mas, uma forma que acho eficiente para autenticação e autorização, fazendo do zero, é com token JWT.
    1. Login: Usuário envia credenciais para o backend em uma requisição HTTPS. Backend valida as informações e retorna um token JWT
    2. Armazenamento do token: O token pode ser salvo no localstorage ou em um cookie.
    3. Autenticação de Requisições: O frontend vai sempre enviar um cabeçalho Authorization: Bearer <token> onde em <token> vai ser passado o token JWT que estará salvo no navegador, através de localStorage ou cookie.
    4. Validação do token: O backend vai receber e validar esse token em cada requisição feita, para que possa garantir que o usuário está autenticado.
    5. Renovação de Token: É interessante implementar um sistema que faça com que o token expire após determinado tempo. Com isso, é importante implementar um mecanismo para fazer o refresh do token, mantendo a sessão ativa sem exigir um novo login.
    6. Logout: Ao realizar logout, o token precisa ser invalidado pelo backend e removido do armazenamento do frontend.

### 3. APIS
Um endpoint da API está demorando muito para responder. Quais técnicas você usaria para
identificar e resolver esse problema no backend?
- Resposta: Primeiramente verificaria a requisição no Dev Tools na aba de network. Ia verificar o tempo que a requisição está levando pra ser completa e, após isso, iria no controller responsável pela requisição começar a debugar cada passo do método responsável por aquela requisição. Avalariaria especialmente queries de banco de dados (provavelmente estariam entre a camada de service e repository). Com isso, caso o problema fosse uma query, ia buscar otimizar a query para que o retorno seja mais rápido e eficiente.

### 4. Integrações
Como a utilização de CDN melhora a performance de uma aplicação web.
- Resposta: A utilização de uma CDN (Content Delivery Network) melhora a performance de uma aplicação web ao distribuir o conteúdo estático (como imagens, CSS, JavaScript) em servidores localizados em diferentes regiões geográficas. Isso reduz a latência, pois os usuários acessam o conteúdo a partir do servidor mais próximo. Além disso, a CDN diminui a carga no servidor principal, melhora o tempo de carregamento e aumenta a escalabilidade e a disponibilidade da aplicação.

### 5. Engenharia de Software e Banco de Dados
Em uma aplicação Laravel utilizando MySQL (RDS), por que seria interessante usar Memcached
ou ElasticCache? Como essas tecnologias ajudam na escalabilidade?
- Resposta: Memcached e ElasticCache são tecnologias de cache que ajudam a melhorar a escalabilidade e o desempenho de aplicações Laravel utilizando MySQL (RDS). Elas armazenam dados frequentemente acessados na memória, reduzindo a carga no banco de dados e diminuindo a latência das consultas. Isso é especialmente útil para dados que não mudam com frequência, como configurações, resultados de consultas complexas ou sessões de usuários. Além disso, essas tecnologias permitem que a aplicação lide com um maior volume de tráfego, melhorando a experiência do usuário e reduzindo custos com infraestrutura.

### 6. Engenharia de Software e Banco de Dados
O que acha de algo como: Quais as vantagens e desvantagens em utilizar o Eloquent do Laravel?
Existe algum possível problema recorrente (N+1 queries)?
- Resposta: O uso do eloquente provê diversas vantagens, como a facilidade no uso, leitura mais intuitiva do código e integração nativa com o framework. Ele permite trabalhar com modelos e relacionamentos de uma forma simples, abstraindo consultas SQL complexas. Ele também oferece recursos como eager loading, mutators e scopes, que ajudam a otimizar o código e deixar mais organizado.

    Do outro lado, o Eloquente pode apresentar desvantagens também, como um menor desempenho em consultas muito complexas ou em cenários com um grande volume de dados, devido a sobrecarga gerada pela abstração. Um dos problemas recorrentes é o N+1 queries, que ocorre quando múltiplas consultas são feitas para carregar relacionamentos em vez de uma única consulta otimizada. Isso pode ser evitado usando eager loading (with) para carregar os relacionamentos necessários de uma forma mais eficiente.

### 7. Engenharia de Software e Banco de Dados
Explique como implementar um sistema de filas assíncronas no Laravel. Para que tipo de
funcionalidades essa abordagem é útil?
- Resposta:

### 8. Engenharia de Software e Banco de Dados
Quando é interessante utilizar transactions?
- Resposta: Transactions são úteis para quando for necessário garantir consistência e integridade dos dados em operações que envolvem múltiplas etapas no banco de dados. Elas permitem que todas as operações sejam concluídas com sucesso ou, em caso de falha, revertam todas as alterações realizadas.

### 9. O que você entende do log abaixo?
```bash
[2018-05-16 01:07:31] production.ERROR: Call to a member function getImage() on null {'exception':'[object]
(Symfony\\Component\\Debug\\Exception\\FatalThrowableError(code: 0): Call to a member function getImage() on null at
/admin/app/Models/Imagem.php:147)

[stacktrace]
#0 /admin/vendor/laravel/framework/src/Illuminate/Cache/Repository.php(362): ChicoRei\\Models\\Imagem-ChicoRei\\Models\\{closure}()
#1 /admin/app/Models/Imagem.php(157): Illuminate\\Cache\\Repository-rememberForever(products_667_im..., Object(Closure))
#2 /admin/app/Transformers/ImagemTransformer.php(25): ChicoRei\\Models\\Imagem-getThumbs()
#3 /admin/vendor/league/fractal/src/Scope.php(338): ChicoRei\\Transformers\\ImagemTransformer-transform(Object(ChicoRei\\Models\\Imagem))
#4 /admin/vendor/league/fractal/src/Scope.php(278): League\\Fractal\\Scope-fireTransformer(Object(ChicoRei\\Transformers\\ImagemTransformer), Object(ChicoRei\\Models\\Imagem))
#5 /admin/vendor/league/fractal/src/Scope.php(208): League\\Fractal\\Scope-executeResourceTransformers()
#6 /admin/vendor/league/fractal/src/TransformerAbstract.php(151): League\\Fractal\\Scope-toArray()
#7 /admin/vendor/league/fractal/src/TransformerAbstract.php(123): League\\Fractal\\TransformerAbstract-includeResourceIfAvailable(Object(League\\Fractal\\Scope), Object(ChicoRei\\Models\\Produto), Array, capa)
#8 /admin/vendor/league/fractal/src/Scope.php(363): League\\Fractal\\TransformerAbstract-processIncludedResources(Object(League\\Fractal\\Scope), Object(ChicoRei\\Models\\Produto))
#9 /admin/vendor/league/fractal/src/Scope.php(342): League\\Fractal\\Scope-fireIncludedTransformers(Object(ChicoRei\\Transformers\\ProdutoTransformer), Object(ChicoRei\\Models\\Produto))
#10 /admin/vendor/league/fractal/src/Scope.php(278): League\\Fractal\\Scope-fireTransformer(Object(ChicoRei\\Transformers\\ProdutoTransformer), Object(ChicoRei\\Models\\Produto))
#11 /admin/vendor/league/fractal/src/Scope.php(208): League\\Fractal\\Scope-executeResourceTransformers()
#12 /admin/app/Factories/ResponseFactory.php(209): League\\Fractal\\Scope-toArray()
#13 /admin/app/Factories/ResponseFactory.php(77): ChicoRei\\Factories\\ResponseFactory-handleItem(Object(ChicoRei\\Models\\Produto),
Object(ChicoRei\\Transformers\\ProdutoTransformer))
#14 /admin/app/Http/Controllers/Api/ProdutoController.php(181): ChicoRei\\Factories\\ResponseFactory-create(Object(ChicoRei\\Models\\Produto))
#15 /admin/vendor/laravel/framework/src/Illuminate/Cache/Repository.php(362): ChicoRei\\Http\\Controllers\\Api\\ProdutoController-ChicoRei\\Http\\Controllers\\Api\\{closure}()
#16 /admin/app/Http/Controllers/Api/ProdutoController.php(182): Illuminate\\Cache\\Repository-rememberForever(products_667_in...,
Object(Closure))
#17 [internal function]: ChicoRei\\Http\\Controllers\\Api\\ProdutoController-info(Object(ChicoRei\\Models\\Produto))
#18 /admin/vendor/laravel/framework/src/Illuminate/Routing/Controller.php(54): call_user_func_array(Array, Array)
#19 /admin/vendor/laravel/framework/src/Illuminate/Routing/ControllerDispatcher.php(45): Illuminate\\Routing\\Controller-callAction(info,
Array)
#20 /admin/vendor/laravel/framework/src/Illuminate/Routing/Route.php(212): Illuminate\\Routing\\ControllerDispatcher-dispatch(Object(Illuminate\\Routing\\Route), Object(ChicoRei\\Http\\Controllers\\Api\\ProdutoController), info)
#21 /admin/vendor/laravel/framework/src/Illuminate/Routing/Route.php(169): Illuminate\\Routing\\Route-runController()
#22 /admin/vendor/laravel/framework/src/Illuminate/Routing/Router.php(659): Illuminate\\Routing\\Route-run()
#23 /admin/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php(30): Illuminate\\Routing\\Router-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#24 /admin/vendor/barryvdh/laravel-cors/src/HandleCors.php(36): Illuminate\\Routing\\Pipeline-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#25 /admin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(149): Barryvdh\\Cors\\HandleCors-handle(Object(Illuminate\\Http\\Request), Object(Closure))
#26 /admin/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php(53): Illuminate\\Pipeline\\Pipeline-Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))
#27 /admin/vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php(41): Illuminate\\Routing\\Pipeline-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#28 /admin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(149): Illuminate\\Routing\\Middleware\\SubstituteBindings-handle(Object(Illuminate\\Http\\Request), Object(Closure))
#29 /admin/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php(53): Illuminate\\Pipeline\\Pipeline-Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))
#30 /admin/app/Http/Middleware/AuthenticateApi.php(57): Illuminate\\Routing\\Pipeline-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#31 /admin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(149): ChicoRei\\Http\\Middleware\\AuthenticateApi-handle(Object(Illuminate\\Http\\Request), Object(Closure))
#32 /admin/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php(53): Illuminate\\Pipeline\\Pipeline-Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))
#33 /admin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(102): Illuminate\\Routing\\Pipeline-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#34 /admin/vendor/laravel/framework/src/Illuminate/Routing/Router.php(661): Illuminate\\Pipeline\\Pipeline-then(Object(Closure))
#35 /admin/vendor/laravel/framework/src/Illuminate/Routing/Router.php(636): Illuminate\\Routing\\Router-runRouteWithinStack(Object(Illuminate\\Routing\\Route), Object(Illuminate\\Http\\Request))
#36 /admin/vendor/laravel/framework/src/Illuminate/Routing/Router.php(602): Illuminate\\Routing\\Router-runRoute(Object(Illuminate\\Http\\Request), Object(Illuminate\\Routing\\Route))
#37 /admin/vendor/laravel/framework/src/Illuminate/Routing/Router.php(591): Illuminate\\Routing\\Router-dispatchToRoute(Object(Illuminate\\Http\\Request))

#38 /admin/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(176): Illuminate\\Routing\\Router-dispatch(Object(Illuminate\\Http\\Request))
#39 /admin/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php(30): Illuminate\\Foundation\\Http\\Kernel-Illuminate\\Foundation\\Http\\{closure}(Object(Illuminate\\Http\\Request))
#40 /admin/app/Http/Middleware/Localize.php(38): Illuminate\\Routing\\Pipeline-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#41 /admin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(149): ChicoRei\\Http\\Middleware\\Localize-handle(Object(Illuminate\\Http\\Request), Object(Closure))
#42 /admin/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php(53): Illuminate\\Pipeline\\Pipeline-Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))
#43 /admin/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/CheckForMaintenanceMode.php(46):
Illuminate\\Routing\\Pipeline-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#44 /admin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(149):
Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode-handle(Object(Illuminate\\Http\\Request), Object(Closure))
#45 /admin/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php(53): Illuminate\\Pipeline\\Pipeline-Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))
#46 /admin/vendor/barryvdh/laravel-cors/src/HandlePreflight.php(35): Illuminate\\Routing\\Pipeline-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#47 /admin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(149): Barryvdh\\Cors\\HandlePreflight-handle(Object(Illuminate\\Http\\Request), Object(Closure))
#48 /admin/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php(53): Illuminate\\Pipeline\\Pipeline-Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))
#49 /admin/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(102): Illuminate\\Routing\\Pipeline-Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))
#50 /admin/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(151): Illuminate\\Pipeline\\Pipeline-then(Object(Closure))
#51 /admin/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(116): Illuminate\\Foundation\\Http\\Kernel-sendRequestThroughRouter(Object(Illuminate\\Http\\Request))
#52 /admin/public/index.php(53): Illuminate\\Foundation\\Http\\Kernel-handle(Object(Illuminate\\Http\\Request))
#53 {main}
}
```
- Resposta: Esse log indica que ocorreu um erro devido a uma tentativa de chamar o método getImage() em um objeto nulo. Isso significa que a variável ou a propriedade que deveria conter uma instância válida de um objeto está `null` no momento em que o método foi chamado. O erro ocorre na model Imagem no seguinte namespace `/admin/app/Models/Imagem.php`, na linha 147 que é onde o método `getImage()` foi chamado em um objeto nulo. O erro se propaga para outras classes e métodos também, que dependem do resultado da chamada desse método `getImage()`.

    Uma solução seria antes de chamar o método, verificar se o objeto não é `null`: 
    ```php
    if ($imagem) {
        $imagem->getImage();
    }
    dd('Imagem é null')
    ```

### 11. Critique o código abaixo e como poderia ser melhorado:
```php
/**
* @param InterfaceItemPedido $orderItem
* @return array
*/
public function transform(InterfaceItemPedido $orderItem)
{
  return [
    'item_pedido_id' => $orderItem->getId(),
    'product_id' => $orderItem->getProductId(),
    'quantity' => $orderItem->getQuantity(),
    'price' => $orderItem->getPrice(),
    'total_price' => $orderItem->getTotalPrice(),
    'discount' => $orderItem->getDiscount(),
    'product_name' => $orderItem->getProduct()->getName(),
    'link_rewrite' => $orderItem->getProduct()->getLinkRewrite(),
    'size_name' => $orderItem->getSize()->getName(),
    'gender' => $orderItem->getSize()->getGender(),
    'gender_name' => $orderItem->getSize()->getLongGender(),
    'active' => $orderItem->getProduct()->isActive(),
    'type' => $orderItem->getProduct()->getType()
  ];
}
```
- Resposta: Cada chamada para getProduct() e getSize() pode resultar em consultas adicionais no banco de dados, resultadno no problema do N+1 queries. Falta também verificações de nulo, da forma atual não tem nenhuma verificação se esses dois métodos retornarão null. Também dá para melhorar a documentação, bem como evitar algumas repetições.
    ```php
        /**
         * Transforma um item de pedido em um array para apresentação na API.
        *
        * @param InterfaceItemPedido $orderItem
        * @return array
        * @throws \Exception Se ocorrer algum erro na transformação
        */
        public function transform(InterfaceItemPedido $orderItem)
        {
            // Acessamos as entidades relacionadas apenas uma vez para evitar múltiplas chamadas
            $product = $orderItem->getProduct();
            $size = $orderItem->getSize();
            
            // Verificações de nulidade para evitar erros
            if (!$product) {
                return [
                    'item_pedido_id' => $orderItem->getId(),
                    'error' => 'Produto não encontrado'
                ];
            }
            
            // Array base com dados do item
            $result = [
                'item_pedido_id' => $orderItem->getId(),
                'product_id' => $orderItem->getProductId(),
                'quantity' => $orderItem->getQuantity(),
                'price' => $orderItem->getPrice(),
                'total_price' => $orderItem->getTotalPrice(),
                'discount' => $orderItem->getDiscount(),
            ];
            
            // Adicionamos dados do produto de forma segura
            $result['product_name'] = $product->getName();
            $result['link_rewrite'] = $product->getLinkRewrite();
            $result['active'] = $product->isActive();
            $result['type'] = $product->getType();
            
            // Adicionamos dados de tamanho se disponíveis
            if ($size) {
                $result['size_name'] = $size->getName();
                $result['gender'] = $size->getGender();
                $result['gender_name'] = $size->getLongGender();
            } else {
                $result['size_name'] = null;
                $result['gender'] = null;
                $result['gender_name'] = null;
            }
            
            return $result;
        }
    ```

### 13. Experiência Profissional
Descreva um projeto desafiador em que você trabalhou recentemente como desenvolvedor full-
stack.

O projeto desafiador é o que mais trabalho na minha empresa: WebQuarto. É um projeto já maduro, portanto, cada nova funcionalidade que vamos adicionar, acaba dando efeito colateral em diversas partes do sistema. Isso é muito bom pois por conta disso me habituei muito bem ao projeto, todas as estruturas, regras de negócio e coisas do tipo. Já adicionei diversas features diferentes, tanto no front quanto no back end. Uma que gostei muito de ter feito foi a criação de espaços para anúncios extras. Na plataforma, atualmente, há um limite de 3 anúncios gratuitos por usuário. Após isso, o usuário ficava sem ter muita opção de fazer um anúncio que ultrapassasse esse limite. E essa feature que adicionei permite que o usuário compre espaços extras (que duram um limite de tempo previamente definido), onde ele poderá ultrapassar o limite de anúncios e ainda assim ter todos eles funcionando naturalmente.

Nessa feature, trabalhei bastante com gerenciamento de estados no front end que é feito em Vue 2 e utiliza Vuex para os estados. Foi uma solução que também exigiu adaptação do back end, começando com a criação de novas tabelas no banco de dados, novos relacionamentos, controllers, services, repositórios etc. Também criei comandos kernel que rodam diariamente e verificam se os anúncios extras estão na data de vencimento, caso sim, eles são desativados automaticamente.

Não tive acesso a repercussão da feature em si, em relação a número de usos etc, mas foi algo que trouxe uma melhora grande na plataforma, especialmente pois trouxe uma nova forma de monetização que contribuiu para o crescimento da empresa.

### 14. SQL
Utilizando a seguinte estrutura de tabelas no MySQL para um banco de dados de vendas:
```sql
CREATE TABLE clientes (
id INT PRIMARY KEY,
nome VARCHAR(100),
email VARCHAR(100),
estado VARCHAR(50)
);
CREATE TABLE pedidos (
id INT PRIMARY KEY,
cliente_id INT,
data_pedido DATE,
valor_total DECIMAL(10,2),
FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);
```
Utilizando o Eloquent do Laravel:
- Escreva uma query para listar os estados com o maior volume de vendas (soma de
valor_total).
    ```php
        <?php
        use Illuminate\Support\Facades\DB;

        $estadosComMaiorVolume = DB::table('clientes')
            ->join('pedidos', 'clientes.id', '=', 'pedidos.cliente_id')
            ->select('clientes.estado', DB::raw('SUM(pedidos.valor_total) as total_vendas'))
            ->groupBy('clientes.estado')
            ->orderByDesc('total_vendas')
            ->get();
    ```
- Escreva uma query para listar os 5 clientes que mais compraram (considerando
valor_total).
    ```php
        $topClientes = DB::table('clientes')
            ->join('pedidos', 'clientes.id', '=', 'pedidos.cliente_id')
            ->select('clientes.nome', DB::raw('SUM(pedidos.valor_total) as total_compras'))
            ->groupBy('clientes.id', 'clientes.nome')
            ->orderByDesc('total_compras')
            ->limit(5)
            ->get();
    ``` 
- Qual seria a melhor forma de otimizar a performance dessas consultas?
    1. Índices no Banco:
        - Criar índices nos campos usados em JOINs e WHERE, como client_id na tabela pedidos e id na tabela clientes.
    2. Reduzir o volume de dados:
        - Usar LIMIT para restringir o número de resultados retornados
    3. Cache:
        - Utilizar cache para armazenar resultados de consultas que nõa mudam frequentemente, como o volume de vendas por estado
    4. Eager Loading:
        - Com o Eloquent, usar o with() para carregar relacionamentos de forma mais otimizada

### 15. SQL
Você trabalhará com um banco de dados relacional contendo informações sobre produtos,
fornecedores e estoque. Seu objetivo é escrever queries SQL para obter insights a partir dessas
tabelas, aplicando funções de agregação e filtragem de dados.
Os dados fornecidos abaixo são fictícios e representam um cenário típico de telas internas.

#### Produtos
| id | nome     | fornecedor_id | categoria   | preco_unit | data_aquisicao |
|----|----------|--------------|------------|------------|----------------|
| 1  | Produto 1 | 1            | Eletrônicos | 150        | 2023-01-10     |
| 2  | Produto 2 | 2            | Eletrônicos | 300        | 2023-02-15     |
| 3  | Produto 3 | 3            | Móveis      | 500        | 2023-03-20     |
| 4  | Produto 4 | 1            | Móveis      | 700        | 2023-01-30     |

#### Fornecedores
| id | nome          | pais     | status   |
|----|---------------|----------|----------|
| 1  | Fornecedor A  | Brasil   | Ativo    |
| 2  | Fornecedor B  | China    | Ativo    |
| 3  | Fornecedor C  | Alemanha | Inativo  |
| 4  | Fornecedor D  | Brasil   | Ativo    |

#### Produtos
| id | produto_id | quantidade | data_contagem |
|----|------------|------------|---------------|
| 1  | 1          | 100        | 2023-06-10    |
| 2  | 2          | 50         | 2023-06-10    |
| 3  | 3          | 20         | 2023-06-10    |
| 4  | 4          | 300        | 2023-06-10    |
| 5  | 5          | 200        | 2023-06-10    |

Utilizando o Eloquent do Laravel
- Escreva uma query para identificar os produtos que possuem estoque abaixo da média
geral
    ```php
        $produtosAbaixoMedia = DB::table('produtos')
            ->join('estoques', 'produtos.id', '=', 'estoques.produto_id')
            ->select('produtos.nome', 'estoques.quantidade')
            ->where('estoques.quantidade', '<', function ($query) {
                $query->from('estoques')
                    ->select(DB::raw('AVG(quantidade)'));
            })
            ->get();
    ```
- Escreva uma query para identificar quais fornecedores possuem produtos cujo preço
unitário é maior que a média dos preços dentro de sua categoria? Exiba o nome do fornecedor, nome do produto, categoria e o preço. (Para melhor análise, lembre de ordenar a tabela por categoria e preço unitário dos produtos.)
    ```php
        $fornecedoresProdutos = DB::table('produtos')
            ->join('fornecedores', 'produtos.fornecedor_id', '=', 'fornecedores.id')
            ->select('fornecedores.nome as fornecedor', 'produtos.nome as produto', 'produtos.categoria', 'produtos.preco_unit')
            ->whereColumn('produtos.preco_unit', '>', function ($query) {
                $query->from('produtos as p')
                    ->select(DB::raw('AVG(p.preco_unit)'))
                    ->whereColumn('p.categoria', 'produtos.categoria');
            })
            ->orderBy('produtos.categoria')
            ->orderByDesc('produtos.preco_unit')
            ->get();
    ```
- Escreva uma query para identificar quais são os produtos mais recentes, adquiridos de fornecedores do Brasil, e possuem estoque acima da média de todos os produtos.
    ```php
        $produtosMaisRecentes = DB::table('produtos')
            ->join('fornecedores', 'produtos.fornecedor_id', '=', 'fornecedores.id')
            ->join('estoques', 'produtos.id', '=', 'estoques.produto_id')
            ->select('produtos.nome', 'produtos.data_aquisicao', 'estoques.quantidade')
            ->where('fornecedores.pais', '=', 'Brasil')
            ->where('estoques.quantidade', '>', function ($query) {
                $query->from('estoques')
                    ->select(DB::raw('AVG(quantidade)'));
            })
            ->orderByDesc('produtos.data_aquisicao')
            ->get();
    ```
