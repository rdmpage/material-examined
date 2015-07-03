# Material examined

Experiments in “resolving” specimen codes to identifiers, with a view to linking specimens across GBIF, GenBank, BOLD, and BioStor. For background see http://iphylo.blogspot.co.uk/2014/08/some-design-notes-on-modelling-links.html, http://iphylo.blogspot.co.uk/2012/02/linking-gbif-and-genbank.html and http://iphylo.blogspot.co.uk/2012/02/gbif-specimens-in-biostor-who-are-top.html. See also:

Guralnick, R. P., Cellinese, N., Deck, J., Pyle, R. L., Kunze, J., Penev, L., … Page, R. (2015, April 6). Community Next Steps for Making Globally Unique Identifiers Work for Biocollections Data. ZooKeys. Pensoft Publishers. http://doi.org/10.3897/zookeys.494.9352

Guralnick, R., Conlin, T., Deck, J., Stucky, B. J., & Cellinese, N. (2014, December 3). The Trouble with Triplets in Biodiversity Informatics: A Data-Driven Case against Current Identifier Practices. (D. P. Little, Ed.)PLoS ONE. Public Library of Science (PLoS). http://doi.org/10.1371/journal.pone.0114069

## Live demo

There is a live demo at http://bionames.org/~rpage/material-examined/. To use simply paste in a specimen code. Some examples include:

* CAS:207283
* MNHN 2003-1054
* MCZ 24351
* BMNH 1891.6.13.25
* KU 3581

## Acknowledgements

Code uses the GBIF API, images of higher taxa from http://phylopic.org



## Notes on matching codes

* BMNH seems to have "lots" in the catalogue for some records

* BMNH 2005.8.9.46 (GenBank EF462257) is 2005.8.9.46-48 in NHM portal (found by searching on taxon Altolamprologus compressiceps)

* NVMD74079 (GenBank HQ699006) is a typo in GenBank for NMVD74079

* QM J59361 Matched to specimen cited by http://biostor.org/reference/105267

* BMNH 3.2.8.15 matched http://gbif.org/occurrence/1056665719 HOLOTYPE, but not of Lemniscomys barbarus but Arvicanthis dunni (described by Thomas 1903 http://biostor.org/reference/145601 ) which also cites the specimen as “B.M. No. 3.2.8.15”

* BMNH 2005.8.9.105 is BMNH 2005.8.9.105-106 in portal (EF462248)

* HUMZ 127670 cited by 10.11369/jji1950.42.39  [japanlinkcenter] http://bionames.org/references/8573d38fb5f77a72a7d05b71c457c643

* BMNH 1886.7.8.1742 sequence AF317712, holotype, sequence not linked in GenBank, paper is 10.1046/j.1474-919X.2002.00036.x, see also 

* USNM 608672 not found by extending (too many), so will need to find fromCouchDB database….

* UF 121176 = EF185121 (type, georef in GBIF, not GenBank, GenBank hasn’t got publication updated)

* UF:UF10868 needs extend 30 to find, matched to occurrence/899580307 (Raoulserenea oxyrhyncha), genBank GQ260977 Raoulserenea komaii “Reef-associated crustacean fauna: biodiversity estimates using semi-quantitative sampling and DNA barcoding” 

— will need CouchDB rules to generate matching codes…

* CBM-ZC 10275 = JF495170 occurrence/857870972 GBIF has as Boninpagurus (doesn’t understand Boninpagurus pilosipes which was originally Eupagurus pilosipes=Pagurus pilosipes

* http://www.gbif.org/occurrence/440011296 MNHN 2011-5550, museum site has this linked to GenBank http://science.mnhn.fr/institution/mnhn/collection/iu/item/2011-5550 -> http://www.ncbi.nlm.nih.gov/nuccore/EU243547 cool, but how do we get this information?

* USNM 580000 holotype with image http://gbif.org/occurrence/888613086, but name not in GBIF hence matched to genus see http://bionames.org/references/f5324553365a0a44c1f2ce655c59254b

* FMNH 252416 taxon name mismatch, this is a type but not of the name GBIF matches it too (sigh)

* EU580885 Knapp & Mallet 9164 (BM), GBIF http://www.gbif.org/occurrence/1056284681 record number 9164

* MNHN_2008-998  GBIF fails to map http://gbif.org/occurrence/583438267 to anything, but genus is present. Also a BOLD sample MBFA840-07 (Moorea) also in GenBank JQ431469 georeferenced (not in GBIF), GenBank vouch is MBIO1419.4, can link via BOLD

* CAS:207283 Paratyle mapped to genus (sigh), but actually Arthroleptis bioko http://bionames.org/references/8560b8e7ef0b4075f4f854b40c8b9b66 genbank HM238196

* BMNH 2002.101 holotype, has verbatim lat and long but not parsed (sigh)

* CAS:HERP:207285 holotype GenBank FJ151053

* TM<ZAF>:84805 = Ditsong Museum, GenBank FJ151080

* TM<ZAF>:40126 = 

* BOLD barcode http://www.boldsystems.org/index.php/Public_RecordView?processid=MBMIA215-06
MBMIA215-06 has Museum ID 9940, deposited in Florida Museum of Natural History, corresponds to http://www.gbif.org/occurrence/147698610 FLMNH 9940-Arthropoda, appears to be duplicated twice (sigh)

* BOLD barcode MBFA013-07 Museum ID:	MParis0017 Sample ID:	MBIO41.4 is http://www.gbif.org/occurrence/583523496 (record number MBIO41, matches date, BOLD is georeferenced), GenBank HM034192 (also Georef), and in GBIF EMBL http://www.gbif.org/occurrence/1009455447 (cited by PLoS One paper http://www.ncbi.nlm.nih.gov/pubmed/22438862 ) and MPE http://www.ncbi.nlm.nih.gov/pubmed/20188843

* MNHN 2003-1054 genbank EF100178 and image 

* RMNH:100621 genbank EU395101

* ZMA 23100 GenBank FJ218464 (different genus)

* FMNH 175398 -> 665890716  [voucher for six sequences] http://www.ncbi.nlm.nih.gov/nuccore/?term=FMNH+175398

* ROM 100393 -> JF448244 -> BOLD 

* JF899877  -> AMNH DOT891 should be AMNH DOT10891, see 10.1016/j.ympev.2011.05.008

* JQ600526 -> ROM:96315, NCBI has as Peromyscus yucatanicus, GBIF has as genus (doesn’t match name)

* KU 124130 type, cited by http://biostor.org/reference/145623

* KU:IT:00312 (tissue) -> GenBank KC828482 (GBIF links lots of sequences)

* KU:IT:3581 - > genbank, images, sequences

* MCZ 24351 some interesting hits…

* AMS I.33464-004 -> KF415599 -> Pubmed

* MVZ163727 -> media is a sound file, which breaks code :(

* NSMT:Mo.72212 -> AB430539

* BMNH 1891.6.13.25 holotype with catalogue image

* MCZ 61146 lots of hits

* MPEG 23603 -> holotype http://dx.doi.org/10.1643/CI-12-087 (BioOne, has lats and longs) GBIF verbatim data has big numbers which are probably lats and longs…

* MPEG 19040 - linked to genus name, lats and longs broken, name is also homonym see http://dx.doi.org/10.3897/zookeys.448.7920 which puts it in a new species Bumba lennoni (MPEG 983 is holotype)

* BMNH 4.12.3.6 is a neotype, has several parts, not all agree on the name(!), neotype designation see http://biostor.org/reference/74749 http://biostor.org/reference/2877

* FMNH 195079 is holotype for Myosorex kabogoensis, see http://biostor.org/reference/140890
FMNH 195181 is also holotype

* FMNH 195069 holotype (GBIF knows this) http://biostor.org/reference/136891 but fails to match the name Surdisorex schlitteri

* HM536372.1 -> SAMA:B23004, both in GBIF

* “YPM 16591; YFTC 9590” in GBIF HQ127981

* AMS R157911 -> DQ675197, twice in GBIF 482599951 774857161 R.157911 and R.157911.001 - GBIF “Scincidae Gray, 1825”, verbatim “ Caledoniscincus sp.”, GenBank Caledoniscincus auratus

* MNHN 1980.1067 GBIF can’t interpret name http://www.gbif.org/occurrence/440166801 why?

* R150712 in GenBank JQ743855 is AMS R150712

* AMS R.148029 (two versions), GBIF has as Caledoniscincus atropunctatus but is paratype of Caledoniscincus notialis http://dx.doi.org/10.11646/zootaxa.3694.6.1

* YPM 1860,, YPM 1920, cited in PeerJ paper https://dx.doi.org/10.7717/peerj.857

* USNM 2364 = USNM V2364.3449150 (FFS)

* FLMNH280692 -> EU543647 Elimia doolyensis name not in GBIF, duplicate datasets? 899438910 147317631

* FLMNH 292208 -> neotype, see e.g. http://biostor.org/reference/145630

* UF 280701 cited in text, voucher for 

* UF:371875 GBIF has no id beyond family, genBank says Leptopecten bavayi

* MNHN-IC.2008-007 GenBank GQ868332 should be “IK”, see http://science.mnhn.fr/institution/mnhn/collection/ik/item/2009-1631

* NRM 50167 -> EU241444 paper has Malayochela maassi, GBIF has 

### Example of type and taxa confusion

USNM 124888 (USNM 124888.7246730) is type of Mus clabatus  http://collections.si.edu/search/results.htm?q=record_ID:nmnhvz_7246730 doi:10.5479/si.00963801.31-1498.575 http://biostor.org/reference/79057 http://biodiversitylibrary.org/page/7737758


KUT 5498 KU tissue, GBIF has three sequences, BLAST search brings up larval fish study

### Hard to match sequence voucher

TRING 1877111743 => BMNH 1877.11.17.43 (voucher for KF281084)

NHM has as Myiagra oceania erythrops, which GBIF matches to “Myiagra oceania”
KF281084 is “Myiagra erythrops”



## Type examples

To search for types in GBIF http://api.gbif.org/v1/occurrence/search?scientificName=Reptilia&typeStatus=HOLOTYPE

### USNM 534311

(bee, fuzzy match but not sure why as got name correct)
See also http://collections.si.edu/search/record/nmnhentomology_9170726 note that GBIF has USNM 534311.9170726, so “.9170726” suffix is local URL id number (handy to know)

Local record also has “USNM Type Number : 12238”, which is how Cockerell refers to it http://bionames.org/references/ae4ba3c4e328ad798469c8aa5d27089c p. 416 doi:10.5479/si.00963801.36-1674.411

basionym Mesotrichia abbotti (GBIF doesn’t have this)


### BMNH 1897.5.13.441

GBIF lists http://www.gbif.org/species/5789258 as holotype of Dicaeum haematostictum Sharpe, 1876, with with fuzzy match
verbatim has scientific name Dicaeum haematostictum whiteheadi Hachisuka, 1926, which is described as Dicæum hæmatostictum whiteheadi p. 55 in http://biostor.org/reference/145719 (http://biodiversitylibrary.org/page/40499064)

Type in British Museum ... Registered No. 1897.5.13.441.
 
### UMMZ 24847

GBIF has as holotype of Dicaeum trigonostigma, but http://www.lsa.umich.edu/ummz/birds/collections/result.asp?textfield=Dicaeum&Submit=Search says holotype of Dicaeum dorsale

### BMNH 1886.7.8.1742

BMNH 1886.7.8.1742 sequence AF317712, holotype, sequence not linked in GenBank, paper is 10.1046/j.1474-919X.2002.00036.x

NHM has as type of Acrocephalus macrorhynchus, See paper 10.1046/j.1474-919X.2002.00036.x :

“This specimen (BMNH registration no. 1886.7.8.1742) was collected on 13 November 1867 in the Sutlej Valley near Rampoor (31°26′N, 77°37′E), Himachal Pradesh, by Allan Hume (Hume 1869). It remained in his collection until 1885 when this came in its entirety to the British Museum (BMNH). The specimen was first provisionally described as Phyllopneuste macrorhyncha (Hume 1869) but the name was changed two years later to Acrocephalus macrorhynchus Hume, 1871 when its generic affinity was established. However, Oberholser (1905) pointed out that this latter name was untenable because a specimen from Egypt, described by von Müller in 1853 as Calamoherpe macrorhyncha, appeared to be a synonym of Clamorous Reed Warbler Acrocephalus stentoreus. Hence, Acrocephalus macrorhynchus was abandoned in favour of the new name Acrocephalus orinus Oberholser, 1905.”

Hume 1871 is 10.1111/j.1474-919x.1871.tb05822.x (Biostor 145727)
Hume 1869 is BioStor 145729

Oberholser is http://bionames.org/references/f6c016797010850e8631a037953fae2f

### USNM 88378

Type of Dasyatis americana (has image)

Mentioned in http://www.gbif.org/species/131870491 (description from Plaza), dataset http://www.gbif.org/dataset/6753c178-d210-4076-bb3a-1fd1739f3120 (doi:10.15468/rzbk7s a GBIF DOI) “A new species of whiptail stingray of the genus Dasyatis Rafinesque, 1810 from the Southwestern Atlantic Ocean (Chondrichthyes: Myliobatiformes: Dasyatidae).”

I guess we could find this by full text search of Plaza DWCA, or just mine text of paper directly….

### BMNH 28.5.3.1

GBIF matches higher taxon, doesn’t know about Talpa klossi (described by Thomas 1929 http://bionames.org/references/10.1080/00222932908672961 doi:10.1080/00222932908672961 )

### USNM 631622

Type of Stiphrornis pyrrholaemus http://bionames.org/references/c6935643d03909f7db975df06faba49f (Zootaxa), specimen is sequenced http://www.ncbi.nlm.nih.gov/nuccore/JQ176287 (seq is known to GBIF, but GBIF doesn’t match name properly, sequence cited by Smithsonian barcoding project). Sequence also in BOLD http://www.boldsystems.org/connectivity/specimenlookup.php?processid=USNMJ331-11.COI-5P

### ANSP 159261

Discussed in “DNA from a 100-year-old holotype confirms the validity of a potentially extinct hummingbird species” DOI: 10.1098/rsbl.2009.0545

### BMNH 1920.6.26.42

GBIF maps to  Spizaetus bartelsi Stresemann, 1924 but is Spizaetus batesi W. L. Sclater, 1919 (description http://biostor.org/reference/145776, see also http://www.zoonomen.net/cit/RI/SP/Sitt/sitt00626a.jpg ) Sclater then synonymises this with Limnaëtus africanus (= Spizaetus africanus) see “Remarks on Spizaëtus batesi” http://biostor.org/reference/145777

### BMNH 8.4.3.73

GBIF maps to *Aethomys chrysophilus* (de Winton, 1897) whereas is holotype for *Mus chrysophilus ineptus* Thomas and Wroughton 1908, see http://bionames.org/references/10.1515/mamm.1998.62.3.427

### CNMA 22439

GBIF has http://gbif.org/occurrence/370555719 identified as *Peromyscus simulus* (by Vargas Cuenca J 2004-7-15), but is holotype of *Habromys delicatulus* described in 2002 see http://biostor.org/reference/81388 

Note that *Peromyscus simulus* has been placed in *Habromys*. Perhaps museum labels haven’t been updated?

Sequence data relevant to this taxon http://dx.doi.org/10.1016/j.ympev.2006.08.019

### KU 161003

Holotype, GBIF matches to family “Cricetidae” whereas verbatim has “Tanyuromys aphrastus” http://www.gbif.org/occurrence/686488116/verbatim  *Tanyuromys* is a genus described in 2012, http://bionames.org/references/376a83d5159fee72deb3f89e16b61c1b, the type species is *Oryzomys aphrastus* Harris, 1932 

So GBIF doesn’t have this combination, and hence can’t match the name.









