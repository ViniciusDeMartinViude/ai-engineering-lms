# How machines learn: grouping colours with K-means

Why might one flower turn into several colours in a machine's output, while two different objects turn into the same colour? In this lab you will ask a model to represent a photograph with a small palette, predict what it will do and inspect where its groups disagree with your idea of an object.

## Learning goals

By the end of this lesson you should be able to identify one example and its features, distinguish a task with target labels from one without them, explain one K-means update in your own words and describe a limitation using evidence from an image.

## Recording guide · 20 minutes

| Time | Demonstration | Question for the learner |
|---|---|---|
| 0–4 min | Show a photograph. Apply a fixed rule that marks pixels for which green is the largest channel. | Who chose the rule? What happens to a grey-green shadow? |
| 4–8 min | Compare predicting electricity consumption, classifying a labelled support message and grouping unlabelled colours. Trace one RGB pixel from the image to a row in a table. | Which examples have a known target during training? |
| 8–14 min | Start with grey levels 20, 30, 200 and 220 and two centres at 10 and 180. Assign each value to its nearest centre, then average each group. Run the same idea on RGB triples. | Where do the two centres move after one update? |
| 14–20 min | Fit palettes of 2, 4 and 8 colours. Darken a copy of the same image and reuse the four original centres. | Which surfaces change groups when only the light changes? |

## Reading

Artificial intelligence includes systems that reason or make decisions using rules and systems that learn from examples. In machine learning, the designer chooses a task and a learning procedure. A *feature* is a measurement available to that procedure. In this lab, one example is one pixel and its three features are red, green and blue intensity.

In **supervised learning**, training examples include the output we want the model to predict. A regression target might be tomorrow's electricity demand in kWh. A classification label might be the topic of a support request. In **unsupervised learning**, we can look for patterns using features alone. Here we supply pixel colours and choose the number of groups, K. There are no flower, leaf or background labels.

K-means alternates two steps. First it assigns each example to the nearest centre using Euclidean distance. Then it moves each centre to the mean of its assigned examples. In the grey-level example, the updated centres are 25 and 210. With RGB, the same calculation runs in three dimensions. Replacing every pixel with its centre gives a compressed *palette*. The output image still has the same dimensions.

Cluster numbers are identifiers. A cluster can contain a leaf and a green sign, and one leaf can occupy several clusters because of shadows. The model sees neither the pixel's position nor the name of its object. This distinction matters in other domains too. Two buildings might have similar energy profiles for entirely different reasons.

## Practical assignment

Open [the notebook](kmeans-colour-lab.ipynb) and follow its setup cell. A CPU and the photograph included with scikit-learn are sufficient. You may also use a photograph you are allowed to share.

1. Before running the comparison, predict which image detail will disappear at K = 2.
2. Run K = 2, 4 and 8 on the same photograph. For each result, identify one detail the palette preserves or loses.
3. Keep the K = 4 centres fixed. Compare the original image with a darker copy, record the percentage of pixels that change group, and identify one region where the result changed or stayed stable.
4. Give one example where similar colour fails to identify an object. Propose one non-image clustering task, name its unit of observation and suggest two features.

Upload your executed notebook with the figures and your answers. If you cannot export a notebook, submit a PDF with the figures, settings and answers. Allow around 70 minutes for the practical work. In the next lesson you will define examples and features for a table of building records.

## Marking criteria · 10 points

| Evidence | Points |
|---|---:|
| Correctly identify the example, features and absence of target labels | 2 |
| Compare all three K values and relate the results to the initial prediction | 3 |
| Report the fixed-centre lighting test and explain one observed region | 3 |
| Explain a colour-grouping failure and propose a plausible non-image application with two features | 2 |
