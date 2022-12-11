# İnternet Vergi Dairesi - Api
Bu paket ile İnteraktif Vergi Dairesi (https://ivd.gib.gov.tr/) üzerinde bulunan, vergi kod listesi, vergi daire listesi gibi herkese açık (public) verilere ulaşabilirsiniz.

### Composer ile Yükleme
```
composer require ahmeti/ivd-api
```

```php
require __DIR__ . '/vendor/autoload.php';

try {
    $ivdService = new \Ahmeti\Ivd\IvdService();
}catch (\Exception $exception){
    print_r($exception);
}
```

## 1. Tüm Veriler (Ham)
```php
$data = $ivdService->getData();
print_r($data);
```

## 2. Vergi Daire Listesi
```php
$data = $ivdService->getVergiDaireListesi();
print_r($data);
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
$data = $ivdService->getVergiKodListesi();
print_r($data);
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

## 4. İl Listesi
```php
$data = $ivdService->getIlListesi();
print_r($data);
```
```php
array:83 [
  0 => {
    "ilKodu": 1
    "ilAdi": "ADANA"
    "ilKoduIlAdi": "1 - ADANA"
  }
  1 => {
    "ilKodu": 2
    "ilAdi": "ADIYAMAN"
    "ilKoduIlAdi": "2 - ADIYAMAN"
  }
  ...
```

## 5. Ülke Listesi
```php
$data = $ivdService->getUlkeListesi();
print_r($data);
```
```php
array:266 [
  0 => {
    "ulkeAdiTUReng": "ABD MINOR OUTLYING ADALARI (US MINOR OUTLYING ISLANDS)"
    "ulkeKodu": "013"
    "ulkeAdi": "ABD MINOR OUTLYING ADALARI"
    "kodAd": "013-ABD MINOR OUTLYING ADALARI"
    "ulkeAdiENG": "US MINOR OUTLYING ISLANDS"
    "egmUlkeKodu": "USA"
  }
  1 => {
    "ulkeAdiTUReng": "ABD VİRJİN ADALARI (US VIRGIN ISLANDS)"
    "ulkeKodu": "457"
    "ulkeAdi": "ABD VİRJİN ADALARI"
    "kodAd": "457-ABD VİRJİN ADALARI"
    "ulkeAdiENG": "US VIRGIN ISLANDS"
    "egmUlkeKodu": "USA"
  }
  ...
```

## 6. Tahsilat Şekil Listesi
```php
$data = $ivdService->getTahsilatSekilListesi();
print_r($data);
```
```php
array:25 [
  0 => {
    "filter": "vezne"
    "text": "Vezne"
    "value": "0"
  }
  1 => {
    "filter": "banka"
    "text": "Banka"
    "value": "1"
  }
  ...
```

## 7. Sicil Doğum Yeri İl İlçe Listesi
```php
$data = $ivdService->getSicilDogumYeriIlIlceListesi();
print_r($data);
```
```php
array:1242 [
  0 => {
    "kod": 2075
    "ilceAdi": "ADANA"
    "ilKodu": 1
    "ilAdi": "ADANA"
    "ilIlceAdi": "ADANA"
  }
  1 => {
    "kod": 1757
    "ilceAdi": "ALADAĞ"
    "ilKodu": 1
    "ilAdi": "ADANA"
    "ilIlceAdi": "ADANA-ALADAĞ"
  }
  ...
```

## 8. Kurum Listesi
```php
$data = $ivdService->getKurumListesi();
print_r($data);
```
```php
array:19 [
  0 => {
    "kod": "59714804"
    "ad": "EMNİYET GENEL MÜDÜRLÜĞÜ"
  }
  1 => {
    "kod": "48909307"
    "ad": "MADEN İŞLERİ GENEL MÜDÜRLÜĞÜ"
  }
  ...
```

## 9. Vergi Dairesi İl Listesi
```php
$data = $ivdService->getVergiDairesiIlListesi();
print_r($data);
```
```php
array:81 [
  0 => {
    "kod": "001"
    "ad": "ADANA"
  }
  1 => {
    "kod": "002"
    "ad": "ADIYAMAN"
  }
  ...
```