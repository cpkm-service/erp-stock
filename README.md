# 創想知識後臺進銷存模板
## 環境需求
1. Laravel > 9.0
1. PHP > 8.1

## 環境配置
1. `vi composer.json`
2. `add`
    ```json
        "repositories": {
            "cpkm/erp-stock": {
                "type": "vcs",
                "url": "git@github.com:cpkm-service/erp-stock.git"
            }
        }
    ```
3. `composer require cpkm-service/erp-stock`
4. `php artisan migrate`

