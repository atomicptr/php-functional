# Atomicptr\Functional\Collection  

A wrapper around PHP arrays enabling piping several functions together

## Implements:
Traversable, IteratorAggregate, ArrayAccess, Atomicptr\Functional\Functor



## Methods

| Name | Description |
|------|-------------|
|[append](#collectionappend)|Append another collection to this collection|
|[cons](#collectioncons)|Add element to new list|
|[drop](#collectiondrop)|Returns a new list with the first $num elements removed.|
|[dropWhile](#collectiondropwhile)|Returns a new list with elements dropped from the start until the predicate function $fn returns false.|
|[every](#collectionevery)|Check if all elements in the collection satisfy the predicate function|
|[filter](#collectionfilter)|Filter the collection based on a predicate function|
|[find](#collectionfind)|Find the first element that satisfies a predicate function|
|[findIndex](#collectionfindindex)|Iterates over $list until one element applied to $fn returns true and returns the index of that element.|
|[first](#collectionfirst)|Retrieves the first element of the list.|
|[flatMap](#collectionflatmap)|Apply a function to each element in the collection and than flatten it|
|[flatten](#collectionflatten)|Flatten a nested collection structure|
|[foldl](#collectionfoldl)|Reduce the collection to a single value, applying the function from left to right|
|[foldr](#collectionfoldr)|Reduce the collection to a single value, applying the function from right to left|
|[forAll](#collectionforall)|Apply a function to each element in the collection without returning a value|
|[from](#collectionfrom)|Create a new collection from an already existing list|
|[fromIterator](#collectionfromiterator)|Create a new collection from an iterator (This will load the entire iterator into memory)|
|[get](#collectionget)|Get the element at the given index, wrapped in an Option|
|[getIterator](#collectiongetiterator)|Create an iterator to iterate over collections|
|[groupBy](#collectiongroupby)|Groups elements of the collection by the result of a callable function.|
|[has](#collectionhas)|Check if the collection has an element at the given index|
|[hd](#collectionhd)|Get the first element of the collection|
|[isEmpty](#collectionisempty)|Is the list empty?|
|[last](#collectionlast)|Retrieves the last element of the list.|
|[length](#collectionlength)|Get the number of elements in the collection|
|[map](#collectionmap)|Apply a function to each element in the collection|
|[offsetExists](#collectionoffsetexists)|Check if the collection has an element at the given index.|
|[offsetGet](#collectionoffsetget)|Get the element at the given index, throws when it doesn't exist|
|[offsetSet](#collectionoffsetset)|This does nothing but throwing|
|[offsetUnset](#collectionoffsetunset)|This does nothing but throwing|
|[partition](#collectionpartition)|Partitions the input list into two arrays based on the given predicate function.|
|[rev](#collectionrev)|Reverse the order of elements in the collection|
|[second](#collectionsecond)|Retrieves the second element of the list.|
|[slice](#collectionslice)|Returns a portion of the list starting at $start with an optional length.|
|[some](#collectionsome)|Check if any element in the collection satisfies the predicate function|
|[sort](#collectionsort)|Sort a list in increasing order according to a comparison function. The comparison function must return 0 if it's arguments compare as equal, a positive integer if the first is greater and a negative integer if the first is smaller (see spaceship operator: <=>)|
|[sortUnique](#collectionsortunique)|Sort a list in increasing order according to a comparison function and remove duplicates.|
|[take](#collectiontake)|Returns a new list containing the first $num elements of the input list.|
|[takeWhile](#collectiontakewhile)|Returns a new list containing elements from the start of the input list until the predicate function $fn returns false.|
|[third](#collectionthird)|Retrieves the third element of the list.|
|[tl](#collectiontl)|Get a new collection with all elements except the first|
|[toArray](#collectiontoarray)|Convert the collection to a PHP array|
|[unique](#collectionunique)|Removes duplicate values from a list.|




### Collection::append  

**Description**

```php
public append (\Collection<\T> $collection)
```

Append another collection to this collection 

 

**Parameters**

* `(\Collection<\T>) $collection`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::cons  

**Description**

```php
public cons (\U $value)
```

Add element to new list 

 

**Parameters**

* `(\U) $value`

**Return Values**

`\Collection<\T|\U>`




<hr />


### Collection::drop  

**Description**

```php
public drop (int $num)
```

Returns a new list with the first $num elements removed. 

 

**Parameters**

* `(int) $num`
: The number of elements to drop  

**Return Values**

`\Collection<\T>`

> A new list with $num elements removed from the start


<hr />


### Collection::dropWhile  

**Description**

```php
public dropWhile (callable $fn)
```

Returns a new list with elements dropped from the start until the predicate function $fn returns false. 

 

**Parameters**

* `(callable) $fn`
: The predicate function  

**Return Values**

`\Collection<\T>`

> A new list with elements dropped until $fn first returns false


<hr />


### Collection::every  

**Description**

```php
public every (callable $fn)
```

Check if all elements in the collection satisfy the predicate function 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`bool`




<hr />


### Collection::filter  

**Description**

```php
public filter (callable $fn)
```

Filter the collection based on a predicate function 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::find  

**Description**

```php
public find (callable $fn)
```

Find the first element that satisfies a predicate function 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Option<\T>`




<hr />


### Collection::findIndex  

**Description**

```php
public findIndex (callable $fn)
```

Iterates over $list until one element applied to $fn returns true and returns the index of that element. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Option<\K>`




<hr />


### Collection::first  

**Description**

```php
public first (void)
```

Retrieves the first element of the list. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`

> The first element of the list


**Throws Exceptions**


`\AssertionError`
> If the list is empty

<hr />


### Collection::flatMap  

**Description**

```php
public flatMap (callable $fn)
```

Apply a function to each element in the collection and than flatten it 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Collection<\U>`




<hr />


### Collection::flatten  

**Description**

```php
public flatten (void)
```

Flatten a nested collection structure 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::foldl  

**Description**

```php
public foldl (callable $fn, \U $initial)
```

Reduce the collection to a single value, applying the function from left to right 

 

**Parameters**

* `(callable) $fn`
* `(\U) $initial`

**Return Values**

`\U`




<hr />


### Collection::foldr  

**Description**

```php
public foldr (callable $fn, \U $initial)
```

Reduce the collection to a single value, applying the function from right to left 

 

**Parameters**

* `(callable) $fn`
* `(\U) $initial`

**Return Values**

`\U`




<hr />


### Collection::forAll  

**Description**

```php
public forAll (callable $fn)
```

Apply a function to each element in the collection without returning a value 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`void`




<hr />


### Collection::from  

**Description**

```php
public static from (\T[] $array)
```

Create a new collection from an already existing list 

 

**Parameters**

* `(\T[]) $array`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::fromIterator  

**Description**

```php
public static fromIterator (\Iterator<\T> $iterator)
```

Create a new collection from an iterator (This will load the entire iterator into memory) 

 

**Parameters**

* `(\Iterator<\T>) $iterator`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::get  

**Description**

```php
public get (int $index)
```

Get the element at the given index, wrapped in an Option 

 

**Parameters**

* `(int) $index`

**Return Values**

`\Option<\T>`




<hr />


### Collection::getIterator  

**Description**

```php
public getIterator (void)
```

Create an iterator to iterate over collections 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Traversable<\T>`




<hr />


### Collection::groupBy  

**Description**

```php
public groupBy (callable $fn)
```

Groups elements of the collection by the result of a callable function. 

 

**Parameters**

* `(callable) $fn`
: A function that takes an element and returns a key for grouping.  

**Return Values**

`\Map<\TKey,\T[]>`

> A Map where keys are the results from $fn and values are arrays of elements that match each key.


<hr />


### Collection::has  

**Description**

```php
public has (mixed $index)
```

Check if the collection has an element at the given index 

 

**Parameters**

* `(mixed) $index`

**Return Values**

`bool`




<hr />


### Collection::hd  

**Description**

```php
public hd (void)
```

Get the first element of the collection 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`




<hr />


### Collection::isEmpty  

**Description**

```php
public isEmpty (void)
```

Is the list empty? 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`




<hr />


### Collection::last  

**Description**

```php
public last (void)
```

Retrieves the last element of the list. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`

> The last element of the list


**Throws Exceptions**


`\AssertionError`
> If the list is empty

<hr />


### Collection::length  

**Description**

```php
public length (void)
```

Get the number of elements in the collection 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`int`




<hr />


### Collection::map  

**Description**

```php
public map (callable $fn)
```

Apply a function to each element in the collection 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Collection<\U>`




<hr />


### Collection::offsetExists  

**Description**

```php
public offsetExists (mixed $offset)
```

Check if the collection has an element at the given index. 

 

**Parameters**

* `(mixed) $offset`

**Return Values**

`bool`




<hr />


### Collection::offsetGet  

**Description**

```php
public offsetGet (mixed $offset)
```

Get the element at the given index, throws when it doesn't exist 

 

**Parameters**

* `(mixed) $offset`

**Return Values**

`\T`




<hr />


### Collection::offsetSet  

**Description**

```php
public offsetSet (void)
```

This does nothing but throwing 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


**Throws Exceptions**


`\ImmutableException`


<hr />


### Collection::offsetUnset  

**Description**

```php
public offsetUnset (void)
```

This does nothing but throwing 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


**Throws Exceptions**


`\ImmutableException`


<hr />


### Collection::partition  

**Description**

```php
public partition (callable $fn)
```

Partitions the input list into two arrays based on the given predicate function. 

 

**Parameters**

* `(callable) $fn`
: The predicate function used to test each element  

**Return Values**

`array{0: \Collection<\T>, 1: \Collection<\T>}`

> A tuple containing two collections:  
- The first collection contains elements for which the predicate returned true  
- The second collection contains elements for which the predicate returned false


**Throws Exceptions**


`\AssertionError`
> If the predicate function returns a non-boolean value

<hr />


### Collection::rev  

**Description**

```php
public rev (void)
```

Reverse the order of elements in the collection 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::second  

**Description**

```php
public second (void)
```

Retrieves the second element of the list. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`

> The second element of the list


**Throws Exceptions**


`\AssertionError`
> If the list has fewer than two elements

<hr />


### Collection::slice  

**Description**

```php
public slice (int $start, ?int $length)
```

Returns a portion of the list starting at $start with an optional length. 

 

**Parameters**

* `(int) $start`
: The starting index (default 0)  
* `(?int) $length`
: The number of elements to include (default null for all remaining)  

**Return Values**

`\Collection<\T>`

> A new list containing the specified slice


<hr />


### Collection::some  

**Description**

```php
public some (callable $fn)
```

Check if any element in the collection satisfies the predicate function 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`bool`




<hr />


### Collection::sort  

**Description**

```php
public sort (callable $fn)
```

Sort a list in increasing order according to a comparison function. The comparison function must return 0 if it's arguments compare as equal, a positive integer if the first is greater and a negative integer if the first is smaller (see spaceship operator: <=>) 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::sortUnique  

**Description**

```php
public sortUnique (callable $fn)
```

Sort a list in increasing order according to a comparison function and remove duplicates. 

The comparison function must return 0 if its arguments compare as equal, a positive integer  
if the first is greater, and a negative integer if the first is smaller (see spaceship operator: <=>).  
Duplicate elements are identified by the comparison function returning 0 and are removed,  
keeping only the first occurrence. 

**Parameters**

* `(callable) $fn`
: Comparison function that determines order and equality  

**Return Values**

`\Collection<\T>`




<hr />


### Collection::take  

**Description**

```php
public take (int $num)
```

Returns a new list containing the first $num elements of the input list. 

 

**Parameters**

* `(int) $num`
: The number of elements to take  

**Return Values**

`\Collection<\T>`

> A new list with up to $num elements


<hr />


### Collection::takeWhile  

**Description**

```php
public takeWhile (callable $fn)
```

Returns a new list containing elements from the start of the input list until the predicate function $fn returns false. 

 

**Parameters**

* `(callable) $fn`
: The predicate function  

**Return Values**

`\Collection<\T>`

> A new list with elements up to where $fn first returns false


<hr />


### Collection::third  

**Description**

```php
public third (void)
```

Retrieves the third element of the list. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`

> The third element of the list


**Throws Exceptions**


`\AssertionError`
> If the list has fewer than three elements

<hr />


### Collection::tl  

**Description**

```php
public tl (void)
```

Get a new collection with all elements except the first 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::toArray  

**Description**

```php
public toArray (void)
```

Convert the collection to a PHP array 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T[]`




<hr />


### Collection::unique  

**Description**

```php
public unique (void)
```

Removes duplicate values from a list. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




<hr />

