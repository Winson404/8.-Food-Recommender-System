from django.apps import AppConfig
import numpy as np
import pandas as pd
from sklearn.preprocessing import OneHotEncoder, LabelEncoder, MinMaxScaler
from sklearn.model_selection import train_test_split
from imblearn.under_sampling import NearMiss
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score
from sklearn.tree import DecisionTreeClassifier


class DecisionTreeClassifierService(AppConfig):
    name = 'recipe_recommender_api'
    verbose_name = "Decision Tree Classifier"
    classifier = None
    le_name_mapping = None
    xle = None

    def ready(self):
        print('Preprocessing and training Decision Tree...')
        dataset = pd.read_csv("api/All_Diets.csv")

        dataset.drop_duplicates(inplace=True, ignore_index=True)
        dataset.drop(columns=['Recipe_name', 'Extraction_day', 'Extraction_time'], inplace=True)
        categories = ['Protein(g)', 'Carbs(g)', 'Fat(g)']

        dataset = dataset.loc[dataset['Diet_type'] != 'paleo']

        X = dataset[categories]
        y = dataset['Diet_type']

        # define the undersampling method
        undersample = NearMiss(version=1, n_neighbors=6)

        # transform the dataset
        X, y = undersample.fit_resample(X, y)

        X_train, X_test, y_train, y_test = train_test_split(X, y, random_state=1, test_size=0.3, shuffle=True)

        X_train_transformed = X_train.copy()
        X_test_transformed = X_test.copy()

        le = LabelEncoder()
        y_train_transformed = le.fit_transform(y_train)
        y_test_transformed = le.transform(y_test)

        DecisionTreeClassifierService.le_name_mapping = dict(zip(le.transform(le.classes_), le.classes_))
        labels = le.transform(le.classes_).tolist()
        classes = le.classes_.tolist()

        DecisionTreeClassifierService.classifier = DecisionTreeClassifier(criterion='gini', random_state=42, max_depth=6
                                                                        # uncomment me if u have scikit-learn > 1.1.0. this will greatly help regularization
                                                                         , ccp_alpha=0.00072
                                                                          )
        DecisionTreeClassifierService.classifier.fit(X_train_transformed, y_train_transformed)
        y_pred = DecisionTreeClassifierService.classifier.predict(X_test_transformed)


#         print("\n------------------- Decision Tree Evaluation -----------------------")

#         cnf_matrix = confusion_matrix(y_test_transformed, y_pred)

#         print(cnf_matrix)
#         print(classification_report(y_test_transformed, y_pred, labels=labels, target_names=classes))

    @classmethod
    def predict(cls, protein, carbs, fat):
        protein = float(protein)
        fat = float(fat)
        carbs = float(carbs)

        X_unseen = pd.DataFrame(np.array([[protein, carbs, fat]]), columns=['Protein(g)', 'Carbs(g)', 'Fat(g)'])

        print(X_unseen.head())

        y_pred = DecisionTreeClassifierService.classifier.predict(X_unseen)

        return DecisionTreeClassifierService.le_name_mapping[y_pred[0]]

    @classmethod
    def compute_show_metrics(cls, y_test, y_pred):
        print("\nConfusion Matrix")
        print(confusion_matrix(y_test, y_pred))
        print("\nClassification Report")
        print(classification_report(y_test, y_pred))
        print("Accuracy: " + str(accuracy_score(y_test, y_pred)))
