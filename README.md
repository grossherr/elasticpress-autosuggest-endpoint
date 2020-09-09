# No Longer Maintained

Take a look at: https://github.com/grossherr/elasticpress-autosuggest-endpoint/issues/12#issuecomment-580247406

# Elasticpress Autosuggest Endpoint

### Configuration:
- Elasticsearch Index name will be set automatically
- Optionally, specify the index name in ep_autosuggest()
- If needed, customize the endpoint in elasticpress-autosuggest-endpoint.php
- Otherwise, keep default settings

### Setup:
- Elasticpress PHP Client is necessary (for Wordpress, see [ElasticPress by 10up](https://github.com/10up/ElasticPress))
- if installed via composer it should be added automatically
- if not, go to plugin directory and  run: composer install --no-dev 

### Elasticpress Autosuggest Settings:
- Default endpoint is http(s)://yourdomainname.com/wp-json/elasticpress/autosuggest/ 
- Use the default endpoint (or whatever you specified in register_rest_route) as the endpoint URL in the admin (ElasticPress / Autosuggest / Settings).
