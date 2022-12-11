# İnternet Vergi Dairesi - Api
Bu paket ile İnternet Vergi Dairesi'de (https://ivd.gib.gov.tr/) bulunan, herkese açık verilere ulaşabilirsiniz.

### Composer ile Yükleme
```
composer require ahmeti/ivd-api
```

```php
require __DIR__ . '/vendor/autoload.php';

$ivdService = new \Ahmeti\Ivd\IvdService();
```

## 1. Tüm Veriler
```php
try {
    $data = $ivdService->getData();
    print_r($data);
}catch (\Exception $exception){
    print_r($exception);
}
```

## 2. Vergi Daire Listesi
```php
try {
    $data = $ivdService->getVergiDaireListesi();
    print_r($data);
}catch (\Exception $exception){
    print_r($exception);
}
```
```php
array:1044[
  0 => {
    "vdKodu": "001103"
    "vdAdi": "FEKE MAL MÜDÜRLÜĞÜ"
    "orgOid": "00000000001108"
    "vdKoduAdi": "001103 FEKE MAL MÜDÜRLÜĞÜ"
    "vdAdiKodu": "FEKE MAL MÜDÜRLÜĞÜ (001103)"
    "ilKodu": "001"
  }
  1 => {
    "vdKodu": "001105"
    "vdAdi": "KARAİSALI MAL MÜDÜRLÜĞÜ"
    "orgOid": "00000000001109"
    "vdKoduAdi": "001105 KARAİSALI MAL MÜDÜRLÜĞÜ"
    "vdAdiKodu": "KARAİSALI MAL MÜDÜRLÜĞÜ (001105)"
    "ilKodu": "001"
  }
  ...
```

## 3. Vergi Kod Listesi
```php
try {
    $data = $ivdService->getVergiKodListesi();
    print_r($data);
}catch (\Exception $exception){
    print_r($exception);
}
```
```php
array:743[
  0 => {
    "gelirTuru": 1
    "tahsilatGrupTipi": "SUREKLI"
    "vergiKisaAdi": "0001 YIL.GEL.V."
    "thsBagsizDurumu": "0"
    "vergiGrubu": 1
    "vergiAdi": "0001 YILLIK GELİR VERGİSİ"
    "topluTkpDurum": "0"
    "vergiKodu": "0001"
  }
  1 => {
    "gelirTuru": 1
    "tahsilatGrupTipi": "SUREKLI"
    "vergiKisaAdi": "0002 ZIRAİ.K.G.V."
    "thsBagsizDurumu": "0"
    "vergiGrubu": 1
    "vergiAdi": "0002 ZIRAİ KAZANÇ GELİR VERGİSİ"
    "topluTkpDurum": "0"
    "vergiKodu": "0002"
  }
  ...
```