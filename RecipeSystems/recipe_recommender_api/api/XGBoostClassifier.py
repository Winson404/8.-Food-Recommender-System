from django.apps import AppConfig
import numpy as np
import pandas as pd
from sklearn.preprocessing import OneHotEncoder, LabelEncoder, MinMaxScaler
from sklearn.model_selection import train_test_split
import xgboost as xgb
from sklearn.compose import ColumnTransformer
import sklearn.metrics as metrics
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score


class XGBoostClassifier(AppConfig):
    name = 'recipe_recommender_api'
    verbose_name = "XGBoost Classifier"
    classifier = None
    le_name_mapping = None
    colTransformer = None

    def ready(self):
        dataset = pd.read_csv("api/All_Diets.csv")

        dataset.drop_duplicates(inplace=True, ignore_index=True)
        dataset.drop(columns=['Recipe_name', 'Extraction_day', 'Extraction_time'], inplace=True)
        categories = ['Protein(g)', 'Carbs(g)', 'Fat(g)']

        X = dataset[categories]
        y = dataset['Diet_type']
        X_train, X_test, y_train, y_test = train_test_split(X, y, random_state=42, test_size=0.25, shuffle=True)

        le = LabelEncoder()
        y_train_transformed = le.fit_transform(y_train)
        y_test_transformed = le.transform(y_test)

        XGBoostClassifier.le_name_mapping = dict(zip(le.transform(le.classes_), le.classes_))
        labels = le.transform(le.classes_).tolist()
        classes = le.classes_.tolist()

        XGBoostClassifier.classifier = xgb.XGBClassifier(objective="multi:softprob", random_state=42, max_depth=8)
        XGBoostClassifier.classifier.fit(X_train, y_train_transformed)

        y_pred = XGBoostClassifier.classifier.predict(X_test)

        print("\n------------------- XGBoost Test -----------------------")

        cnf_matrix = confusion_matrix(y_test_transformed, y_pred)

        print(cnf_matrix)
        print(classification_report(y_test_transformed, y_pred, labels=labels, target_names=classes))


    @classmethod
    def predict(cls, protein, carbs, fat):
        protein = float(protein)
        fat = float(fat)
        carbs = float(carbs)

        X_unseen = pd.DataFrame(np.array([[protein, carbs, fat]]), columns=['Cuisine_type', 'Protein(g)', 'Carbs(g)', 'Fat(g)'])

        X_unseen['Cuisine_type'].replace(' ', '_', regex=True, inplace=True)

        print(X_unseen.head())

        X_unseen_transformed = XGBoostClassifier.colTransformer.transform(X_unseen)

        y_pred = XGBoostClassifier.classifier.predict(X_unseen_transformed)

        return XGBoostClassifier.le_name_mapping[y_pred[0]]

    @classmethod
    def compute_show_metrics(cls, y_test, y_pred):
        print("\nConfusion Matrix")
        print(confusion_matrix(y_test, y_pred))
        print("\nClassification Report")
        print(classification_report(y_test, y_pred))
        print("Accuracy: " + str(accuracy_score(y_test, y_pred)))
        print("Mean Squared Error: " + str(metrics.mean_squared_error(y_test, y_pred)) + "\n")