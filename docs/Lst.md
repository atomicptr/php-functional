# Atomicptr\Functional\Lst  

A collection of functions for operating on "lists" (PHP arrays)

Note: Map like arrays are generally unsupported but might work, this class is for lists  





## Methods

| Name | Description |
|------|-------------|
|[append](#lstappend)|Concatenates two lists.|
|[cons](#lstcons)|Add element to new list|
|[every](#lstevery)|Returns true if all elements in the list satisfy the predicate $fn.|
|[filter](#lstfilter)|Applies the function $fn to every element of $list and builds a new list with the elements of $list where $fn returned true|
|[find](#lstfind)|Iterates over $list until one element applied to $fn returns true and return that element.|
|[first](#lstfirst)|Retrieves the first element of the list.|
|[flatten](#lstflatten)|Flattens a nested array structure.|
|[foldl](#lstfoldl)|Reduces the array to a single value by applying $fn from left to right.|
|[foldr](#lstfoldr)|Reduces the array to a single value by applying $fn from right to left.|
|[forAll](#lstforall)|Applies the function $fn to every element of $list.|
|[groupBy](#lstgroupby)|Groups elements of an array by the result of a callable function.|
|[hd](#lsthd)|Returns the first element of the list.|
|[init](#lstinit)|Creates a new list of given length using the provided function.|
|[isEmpty](#lstisempty)|Is the list empty?|
|[last](#lstlast)|Retrieves the last element of the list.|
|[length](#lstlength)|Returns the number of elements in the list.|
|[map](#lstmap)|Applies the function $fn to every element of $list and builds a new list with the results returned by $fn.|
|[nth](#lstnth)|Retrieves the element at the specified index in the list.|
|[partition](#lstpartition)|Partitions the input list into two arrays based on the given predicate function.|
|[rev](#lstrev)|Returns a new list with elements in reverse order.|
|[second](#lstsecond)|Retrieves the second element of the list.|
|[some](#lstsome)|Returns true if at least one element in the list satisfies the predicate $fn.|
|[sort](#lstsort)|Sort a list in increasing order according to a comparison function. The comparison function must return 0 if it's arguments compare as equal, a positive integer if the first is greater and a negative integer if the first is smaller (see spaceship operator: <=>)|
|[third](#lstthird)|Retrieves the third element of the list.|
|[tl](#lsttl)|Returns a new list containing all elements except the first.|
|[tryNth](#lsttrynth)|Attempts to retrieve the element at the specified index in the list.|




### Lst::append  

**Description**

```php
public static append (\T[] $lst1, \U[] $lst2)
```

Concatenates two lists. 

 

**Parameters**

* `(\T[]) $lst1`
* `(\U[]) $lst2`

**Return Values**

`(\T|\U)[]`




<hr />


### Lst::cons  

**Description**

```php
public static cons (\T[] $lst, \U $value)
```

Add element to new list 

 

**Parameters**

* `(\T[]) $lst`
* `(\U) $value`

**Return Values**

`(\T|\U)[]`




<hr />


### Lst::every  

**Description**

```php
public static every (callable $fn)
```

Returns true if all elements in the list satisfy the predicate $fn. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`bool`




<hr />


### Lst::filter  

**Description**

```php
public static filter (callable $fn)
```

Applies the function $fn to every element of $list and builds a new list with the elements of $list where $fn returned true 

Same as array_filter 

**Parameters**

* `(callable) $fn`

**Return Values**

`void`


<hr />


### Lst::find  

**Description**

```php
public static find (callable $fn)
```

Iterates over $list until one element applied to $fn returns true and return that element. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Option<\T>`




<hr />


### Lst::first  

**Description**

```php
public static first (\T[] $lst)
```

Retrieves the first element of the list. 

 

**Parameters**

* `(\T[]) $lst`
: The input list  

**Return Values**

`\T`

> The first element of the list


**Throws Exceptions**


`\AssertionError`
> If the list is empty

<hr />


### Lst::flatten  

**Description**

```php
public static flatten ((\T|\T[])[] $lst)
```

Flattens a nested array structure. 

 

**Parameters**

* `((\T|\T[])[]) $lst`

**Return Values**

`\T[]`




<hr />


### Lst::foldl  

**Description**

```php
public static foldl (callable $fn, \R $initial)
```

Reduces the array to a single value by applying $fn from left to right. 

 

**Parameters**

* `(callable) $fn`
* `(\R) $initial`

**Return Values**

`\R`




<hr />


### Lst::foldr  

**Description**

```php
public static foldr (callable $fn, \R $initial)
```

Reduces the array to a single value by applying $fn from right to left. 

 

**Parameters**

* `(callable) $fn`
* `(\R) $initial`

**Return Values**

`\R`




<hr />


### Lst::forAll  

**Description**

```php
public static forAll (callable $fn)
```

Applies the function $fn to every element of $list. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`void`




<hr />


### Lst::groupBy  

**Description**

```php
public static groupBy (callable $fn, \TValue[] $lst)
```

Groups elements of an array by the result of a callable function. 

 

**Parameters**

* `(callable) $fn`
: A function that takes an element and returns a key for grouping.  
* `(\TValue[]) $lst`
: The list of elements to be grouped.  

**Return Values**

`\Map<\TKey,\TValue[]>`

> A Map where keys are the results from $fn and values are arrays of elements that match each key.


<hr />


### Lst::hd  

**Description**

```php
public static hd (\T[] $lst)
```

Returns the first element of the list. 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`\T`




<hr />


### Lst::init  

**Description**

```php
public static init (callable $fn, int $length)
```

Creates a new list of given length using the provided function. 

 

**Parameters**

* `(callable) $fn`
* `(int) $length`

**Return Values**

`\T[]`




<hr />


### Lst::isEmpty  

**Description**

```php
public static isEmpty (\T[] $lst)
```

Is the list empty? 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`bool`




<hr />


### Lst::last  

**Description**

```php
public static last (\T[] $lst)
```

Retrieves the last element of the list. 

 

**Parameters**

* `(\T[]) $lst`
: The input list  

**Return Values**

`\T`

> The last element of the list


**Throws Exceptions**


`\AssertionError`
> If the list is empty

<hr />


### Lst::length  

**Description**

```php
public static length (\T[] $lst)
```

Returns the number of elements in the list. 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`int`




<hr />


### Lst::map  

**Description**

```php
public static map (callable $fn)
```

Applies the function $fn to every element of $list and builds a new list with the results returned by $fn. 

Same as array_map 

**Parameters**

* `(callable) $fn`

**Return Values**

`void`


<hr />


### Lst::nth  

**Description**

```php
public static nth (\T[] $lst, int $index)
```

Retrieves the element at the specified index in the list. 

 

**Parameters**

* `(\T[]) $lst`
: The input list  
* `(int) $index`
: The index to retrieve  

**Return Values**

`\T`

> The element at the specified index


**Throws Exceptions**


`\AssertionError`
> If the index is out of bounds

<hr />


### Lst::partition  

**Description**

```php
public static partition (callable $fn)
```

Partitions the input list into two arrays based on the given predicate function. 

 

**Parameters**

* `(callable) $fn`
: The predicate function used to test each element  

**Return Values**

`array{0: \T[], 1: \T[]}`

> A tuple containing two arrays:  
- The first array contains elements for which the predicate returned true  
- The second array contains elements for which the predicate returned false


**Throws Exceptions**


`\AssertionError`
> If the predicate function returns a non-boolean value

<hr />


### Lst::rev  

**Description**

```php
public static rev (\T[] $lst)
```

Returns a new list with elements in reverse order. 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`\T[]`




<hr />


### Lst::second  

**Description**

```php
public static second (\T[] $lst)
```

Retrieves the second element of the list. 

 

**Parameters**

* `(\T[]) $lst`
: The input list  

**Return Values**

`\T`

> The second element of the list


**Throws Exceptions**


`\AssertionError`
> If the list has fewer than two elements

<hr />


### Lst::some  

**Description**

```php
public static some (callable $fn)
```

Returns true if at least one element in the list satisfies the predicate $fn. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`bool`




<hr />


### Lst::sort  

**Description**

```php
public static sort (callable $fn, \T[] $lst)
```

Sort a list in increasing order according to a comparison function. The comparison function must return 0 if it's arguments compare as equal, a positive integer if the first is greater and a negative integer if the first is smaller (see spaceship operator: <=>) 

 

**Parameters**

* `(callable) $fn`
* `(\T[]) $lst`

**Return Values**

`\T[]`




<hr />


### Lst::third  

**Description**

```php
public static third (\T[] $lst)
```

Retrieves the third element of the list. 

 

**Parameters**

* `(\T[]) $lst`
: The input list  

**Return Values**

`\T`

> The third element of the list


**Throws Exceptions**


`\AssertionError`
> If the list has fewer than three elements

<hr />


### Lst::tl  

**Description**

```php
public static tl (\T[] $lst)
```

Returns a new list containing all elements except the first. 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`\T[]`




<hr />


### Lst::tryNth  

**Description**

```php
public static tryNth (\T[] $lst, int $index)
```

Attempts to retrieve the element at the specified index in the list. 

 

**Parameters**

* `(\T[]) $lst`
: The input list  
* `(int) $index`
: The index to retrieve  

**Return Values**

`\Option<\T>`

> An Option containing the element if it exists, or None if the index is out of bounds


<hr />

