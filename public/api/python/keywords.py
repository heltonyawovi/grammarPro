import yake


def getKeywords(doc):
    kw_extractor = yake.KeywordExtractor(n=3, top=15)
    keywords = kw_extractor.extract_keywords(doc)
    keywordsList = ""

    for kw in keywords:
        print(kw)
        keywordsList += kw[0] + "+"
        print(keywordsList)

    return keywords

